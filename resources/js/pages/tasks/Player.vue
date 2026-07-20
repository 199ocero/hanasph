<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { CheckCircle2, ListChecks, Sparkles } from '@lucide/vue';
import { computed, ref, watch } from 'vue';
import AttemptController from '@/actions/App/Http/Controllers/AttemptController';
import FreeTextAttemptController from '@/actions/App/Http/Controllers/FreeTextAttemptController';
import BeatProgress from '@/components/BeatProgress.vue';
import ClientMessage from '@/components/ClientMessage.vue';
import DiagnosticPanel from '@/components/DiagnosticPanel.vue';
import MicroLesson from '@/components/MicroLesson.vue';
import OptionList from '@/components/OptionList.vue';
import SuggestedReply from '@/components/SuggestedReply.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Skeleton } from '@/components/ui/skeleton';
import { Spinner } from '@/components/ui/spinner';
import { dashboard } from '@/routes';
import { isAiFeedback } from '@/types/tasks';
import type {
    AiFeedback,
    AttemptFeedback,
    McFeedback,
    PlayerBeat,
    PlayerTask,
} from '@/types/tasks';

const props = defineProps<{
    task: PlayerTask;
    beat: PlayerBeat;
    currentBeatIndex: number;
    isPassed: boolean;
    showOptionsDefault: boolean;
    feedback: AttemptFeedback | null;
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Track', href: dashboard() }],
    },
});

const isFreeText = computed(() => props.task.aiGradingEnabled);

const activeFeedback = ref<AttemptFeedback | null>(props.feedback);

// Multiple-choice state (also used as the free-text scaffold).
const selectedId = ref<number | null>(null);
const mcForm = useForm<{ option_id: number | null }>({ option_id: null });

// Free-text state.
const replyForm = useForm<{ reply_text: string }>({ reply_text: '' });
const optionsRevealed = ref(false);
const failedAiAttempts = ref(0);

// A new beat (a server round-trip that advanced) resets everything.
watch(
    () => props.beat.id,
    () => {
        selectedId.value = null;
        activeFeedback.value = null;
        mcForm.reset();
        replyForm.reset();
        optionsRevealed.value = false;
        failedAiAttempts.value = 0;
    },
);

// Incoming feedback drives the hybrid scaffold: reveal options after a failed
// AI attempt or when the grader is unavailable.
watch(
    () => props.feedback,
    (value) => {
        activeFeedback.value = value;

        if (isAiFeedback(value) && !value.correct && !value.rejected) {
            if (value.graderUnavailable) {
                optionsRevealed.value = true;
            } else {
                failedAiAttempts.value += 1;
            }
        }
    },
);

const mcFeedback = computed<McFeedback | null>(() =>
    activeFeedback.value && !isAiFeedback(activeFeedback.value)
        ? activeFeedback.value
        : null,
);
const aiFeedback = computed<AiFeedback | null>(() =>
    isAiFeedback(activeFeedback.value) ? activeFeedback.value : null,
);

const mcDiagnosticShowing = computed(
    () => mcFeedback.value !== null && !mcFeedback.value.correct,
);

// In multiple-choice tasks the options are always shown. In free-text tasks
// they are a scaffold: revealed for beginners, on request, or after a miss.
const optionsVisible = computed(
    () =>
        !isFreeText.value ||
        props.showOptionsDefault ||
        optionsRevealed.value ||
        failedAiAttempts.value > 0,
);

function submitReply(): void {
    if (replyForm.reply_text.trim().length === 0) {
        return;
    }

    replyForm.post(
        FreeTextAttemptController.store.url({
            task: props.task.slug,
            beat: props.beat.id,
        }),
        { preserveScroll: true },
    );
}

function submitOption(): void {
    if (selectedId.value === null) {
        return;
    }

    mcForm.option_id = selectedId.value;
    mcForm.post(
        AttemptController.store.url({
            task: props.task.slug,
            beat: props.beat.id,
        }),
        { preserveScroll: true },
    );
}

function retryMc(): void {
    activeFeedback.value = null;
    selectedId.value = null;
    mcForm.reset();
}

function dismissAiFeedback(): void {
    activeFeedback.value = null;
}

function useSuggested(reply: string): void {
    replyForm.reply_text = reply;
    activeFeedback.value = null;
}
</script>

<template>
    <Head :title="task.title" />

    <div class="mx-auto flex w-full max-w-2xl flex-1 flex-col gap-6 p-4">
        <!-- Header -->
        <div
            class="flex animate-in flex-col gap-3 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <div class="flex items-center justify-between gap-3">
                <h1 class="font-display text-xl font-semibold text-foreground">
                    {{ task.title }}
                </h1>
                <BeatProgress
                    :current="currentBeatIndex"
                    :total="task.beatCount"
                />
            </div>
            <p class="text-sm text-muted-foreground">
                {{ task.scenarioIntro }}
            </p>
        </div>

        <!-- Passed banner (replay) -->
        <Card v-if="isPassed" class="glow-success border-success/40">
            <CardContent class="flex items-center gap-3">
                <CheckCircle2 class="size-5 text-success" />
                <p class="flex-1 text-sm text-foreground">
                    You've already passed this task. Nice work.
                </p>
                <Button as-child variant="secondary" size="sm">
                    <Link :href="dashboard()">Back to Track</Link>
                </Button>
            </CardContent>
        </Card>

        <!-- Client message -->
        <Card
            class="animate-in delay-75 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <CardContent>
                <ClientMessage
                    :persona="task.clientPersona"
                    :message="beat.clientMessage"
                    :scaffold-hint="beat.scaffoldHint"
                />
            </CardContent>
        </Card>

        <!-- Free-text composer -->
        <div
            v-if="isFreeText"
            class="animate-in space-y-3 delay-150 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <textarea
                v-model="replyForm.reply_text"
                :disabled="replyForm.processing"
                rows="4"
                placeholder="Type how you'd reply to the client, in your own words…"
                class="min-h-28 w-full rounded-md border border-input bg-transparent px-3 py-2 text-sm text-foreground shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50 dark:bg-input/30"
            />
            <div class="flex items-center justify-between gap-3">
                <Button
                    v-if="!optionsVisible"
                    type="button"
                    variant="ghost"
                    size="sm"
                    @click="optionsRevealed = true"
                >
                    <ListChecks class="size-4" />
                    Show me options
                </Button>
                <span v-else />
                <Button
                    type="button"
                    size="lg"
                    :disabled="
                        replyForm.processing ||
                        replyForm.reply_text.trim().length === 0
                    "
                    @click="submitReply"
                >
                    <Spinner v-if="replyForm.processing" />
                    Send reply
                </Button>
            </div>
        </div>

        <!-- Grading skeleton -->
        <Card v-if="replyForm.processing">
            <CardContent class="space-y-3">
                <div
                    class="flex items-center gap-2 text-sm text-muted-foreground"
                >
                    <Sparkles class="size-4 animate-pulse text-primary" />
                    Reading your reply…
                </div>
                <Skeleton class="h-4 w-3/4" />
                <Skeleton class="h-4 w-full" />
                <Skeleton class="h-4 w-2/3" />
            </CardContent>
        </Card>

        <!-- AI feedback on a reply that didn't pass -->
        <template
            v-if="aiFeedback && !aiFeedback.correct && !replyForm.processing"
        >
            <div
                v-if="aiFeedback.rejected"
                class="animate-in rounded-xl border border-warning/40 bg-warning/10 p-4 text-sm text-muted-foreground duration-300 fade-in slide-in-from-bottom-2"
            >
                {{ aiFeedback.feedback }}
            </div>
            <div
                v-else-if="aiFeedback.graderUnavailable"
                class="animate-in rounded-xl border border-border bg-muted/40 p-4 text-sm text-muted-foreground duration-300 fade-in slide-in-from-bottom-2"
            >
                Our coach is busy right now — pick from the options below
                instead.
            </div>
            <template v-else>
                <div
                    class="animate-in space-y-2 rounded-xl border border-destructive/40 bg-destructive/10 p-4 duration-300 fade-in slide-in-from-bottom-2"
                >
                    <div class="flex items-center justify-between gap-2">
                        <p
                            class="font-display text-sm font-semibold text-foreground"
                        >
                            Not quite yet
                        </p>
                        <span
                            class="font-display text-sm font-semibold text-muted-foreground"
                        >
                            {{ aiFeedback.score }}/100
                        </span>
                    </div>
                    <p
                        v-if="aiFeedback.feedback"
                        class="text-sm leading-relaxed text-muted-foreground"
                    >
                        {{ aiFeedback.feedback }}
                    </p>
                </div>

                <SuggestedReply
                    v-if="aiFeedback.suggestedReply"
                    :reply="aiFeedback.suggestedReply"
                    @use="useSuggested"
                />
                <DiagnosticPanel
                    v-if="aiFeedback.diagnostic"
                    :diagnostic="aiFeedback.diagnostic"
                />
                <MicroLesson
                    v-if="aiFeedback.lesson"
                    :title="aiFeedback.lesson.title"
                    :body="aiFeedback.lesson.body"
                    @retry="dismissAiFeedback"
                />
            </template>
        </template>

        <!-- Options (primary in MC tasks, scaffold in free-text tasks) -->
        <div
            v-if="optionsVisible"
            class="animate-in space-y-3 delay-150 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <p
                v-if="isFreeText"
                class="text-xs font-medium tracking-wide text-muted-foreground uppercase"
            >
                Or pick a reply
            </p>
            <OptionList
                :options="beat.options"
                :selected-id="selectedId"
                :locked="mcDiagnosticShowing"
                :processing="mcForm.processing"
                :wrong-id="
                    mcDiagnosticShowing ? mcFeedback!.selectedOptionId : null
                "
                @update:selected-id="selectedId = $event"
                @submit="submitOption"
            />
        </div>

        <!-- Diagnostic + lesson on a wrong multiple-choice answer -->
        <template v-if="mcDiagnosticShowing && mcFeedback">
            <DiagnosticPanel
                v-if="mcFeedback.diagnostic"
                :diagnostic="mcFeedback.diagnostic"
            />
            <MicroLesson
                v-if="mcFeedback.lesson"
                :title="mcFeedback.lesson.title"
                :body="mcFeedback.lesson.body"
                @retry="retryMc"
            />
            <Button v-else variant="secondary" size="lg" @click="retryMc">
                Try again
            </Button>
        </template>
    </div>
</template>
