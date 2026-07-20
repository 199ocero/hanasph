<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { ArrowLeft, CircleCheckBig, Sparkles } from '@lucide/vue';
import { computed, onUnmounted, watch } from 'vue';
import { show as courseShow } from '@/actions/App/Http/Controllers/SkillCourseController';
import { store as submitAction } from '@/actions/App/Http/Controllers/SubmissionController';
import CritiquePanel from '@/components/CritiquePanel.vue';
import SubmissionUploader from '@/components/SubmissionUploader.vue';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent } from '@/components/ui/card';
import { Skeleton } from '@/components/ui/skeleton';
import { dashboard } from '@/routes';
import type { LessonSubmission, SubmissionFormat } from '@/types/skills';

const props = defineProps<{
    course: { skillKey: string; title: string };
    lesson: {
        id: number;
        order: number;
        title: string;
        brief: string;
        acceptedFormats: SubmissionFormat[];
        difficulty: string;
        xpReward: number;
    };
    passed: boolean;
    submission: LessonSubmission | null;
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Courses', href: dashboard() }],
    },
});

const submitUrl = computed(() =>
    submitAction.url({
        course: props.course.skillKey,
        lesson: props.lesson.id,
    }),
);
const courseUrl = computed(() =>
    courseShow.url({ course: props.course.skillKey }),
);

const isQueued = computed(() => props.submission?.status === 'queued');
const isGraded = computed(() => props.submission?.status === 'graded');
const isFailed = computed(() => props.submission?.status === 'failed');

// Poll while a submission is being reviewed off the request cycle.
let pollTimer: ReturnType<typeof setInterval> | undefined;

function stopPolling(): void {
    if (pollTimer !== undefined) {
        clearInterval(pollTimer);
        pollTimer = undefined;
    }
}

watch(
    () => props.submission?.status,
    (status) => {
        if (status === 'queued') {
            stopPolling();
            pollTimer = setInterval(() => {
                router.reload({ only: ['submission', 'passed'] });
            }, 3000);
        } else {
            stopPolling();
        }
    },
    { immediate: true },
);

onUnmounted(stopPolling);
</script>

<template>
    <Head :title="lesson.title" />

    <div class="mx-auto flex w-full max-w-2xl flex-1 flex-col gap-6 p-4">
        <div
            class="flex animate-in flex-col gap-2 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <Link
                :href="courseUrl"
                class="inline-flex items-center gap-1 text-sm text-muted-foreground transition-colors hover:text-foreground"
            >
                <ArrowLeft class="size-4" />
                {{ course.title }}
            </Link>
            <div class="flex items-center gap-2">
                <h1 class="font-display text-xl font-semibold text-foreground">
                    {{ lesson.title }}
                </h1>
                <Badge v-if="passed" variant="secondary">
                    <CircleCheckBig class="size-3 text-success" />
                    Passed
                </Badge>
            </div>
        </div>

        <!-- Brief -->
        <Card
            class="animate-in delay-75 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <CardContent class="space-y-2">
                <p
                    class="text-xs font-medium tracking-wide text-muted-foreground uppercase"
                >
                    The brief · {{ lesson.xpReward }} XP
                </p>
                <p
                    class="text-sm leading-relaxed whitespace-pre-line text-foreground"
                >
                    {{ lesson.brief }}
                </p>
            </CardContent>
        </Card>

        <!-- Reviewing skeleton -->
        <Card v-if="isQueued">
            <CardContent class="space-y-3">
                <div
                    class="flex items-center gap-2 text-sm text-muted-foreground"
                >
                    <Sparkles class="size-4 animate-pulse text-primary" />
                    Reviewing your work…
                </div>
                <Skeleton class="h-4 w-3/4" />
                <Skeleton class="h-4 w-full" />
                <Skeleton class="h-4 w-2/3" />
            </CardContent>
        </Card>

        <!-- Critique -->
        <CritiquePanel
            v-else-if="isGraded && submission && submission.score !== null"
            :score="submission.score"
            :passed="submission.passed ?? false"
            :strengths="submission.strengths"
            :fixes="submission.fixes"
            :next-step="submission.nextStep"
        />

        <!-- Grader failure -->
        <div
            v-else-if="isFailed"
            class="rounded-xl border border-border bg-muted/40 p-4 text-sm text-muted-foreground"
        >
            We couldn't review that submission — please try submitting again.
        </div>

        <!-- Uploader (hidden only while a review is in flight) -->
        <div v-if="!isQueued" class="space-y-2">
            <p
                v-if="submission"
                class="text-xs font-medium tracking-wide text-muted-foreground uppercase"
            >
                {{ passed ? 'Practice again' : 'Try again' }}
            </p>
            <SubmissionUploader
                :accepted-formats="lesson.acceptedFormats"
                :submit-url="submitUrl"
            />
        </div>

        <div v-if="passed" class="flex justify-end">
            <Link
                :href="courseUrl"
                class="inline-flex items-center gap-1 text-sm font-medium text-primary transition-colors hover:text-primary/80"
            >
                Back to course
                <ArrowLeft class="size-4 rotate-180" />
            </Link>
        </div>
    </div>
</template>
