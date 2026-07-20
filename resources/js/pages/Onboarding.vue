<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import {
    ArrowRight,
    Briefcase,
    Calendar,
    Check,
    Globe,
    Headset,
    Megaphone,
    Sparkles,
} from '@lucide/vue';
import { computed, ref } from 'vue';
import OnboardingController from '@/actions/App/Http/Controllers/OnboardingController';
import LessonTip from '@/components/LessonTip.vue';
import { Button } from '@/components/ui/button';
import { Progress } from '@/components/ui/progress';
import { Spinner } from '@/components/ui/spinner';

type Choice = { value: string; emoji: string; label: string };

type VaTaskExample = { icon: typeof Calendar; label: string; blurb: string };

const vaTaskExamples: VaTaskExample[] = [
    {
        icon: Calendar,
        label: 'Inbox & Calendar',
        blurb: 'Manage email, scheduling, and reminders',
    },
    {
        icon: Briefcase,
        label: 'Admin & Data',
        blurb: 'Organize files, spreadsheets, and research',
    },
    {
        icon: Megaphone,
        label: 'Social Media',
        blurb: 'Plan posts and reply to followers',
    },
    {
        icon: Headset,
        label: 'Customer Support',
        blurb: 'Answer client and customer questions',
    },
];

type VaIndustryStat = { icon: typeof Globe; value: string; label: string };

const vaIndustryStats: VaIndustryStat[] = [
    { icon: Globe, value: '1.5M+', label: 'Filipino VAs worldwide' },
    { icon: Headset, value: '92%', label: 'English proficiency' },
    { icon: Briefcase, value: 'Primary career', label: 'Not a side gig' },
];

const skills: Choice[] = [
    { value: 'admin', emoji: '🗂️', label: 'Admin & Organization' },
    { value: 'social_media', emoji: '📱', label: 'Social Media Management' },
    { value: 'design', emoji: '🎨', label: 'Design & Creative' },
    { value: 'customer_support', emoji: '💬', label: 'Customer Support' },
    { value: 'tech', emoji: '💻', label: 'Tech & Programming' },
    { value: 'writing', emoji: '✍️', label: 'Writing & Content' },
    { value: 'data_entry', emoji: '📊', label: 'Data Entry & Research' },
    {
        value: 'project_management',
        emoji: '📋',
        label: 'Project & Team Management',
    },
    {
        value: 'none_yet',
        emoji: '🌱',
        label: "None yet, I'm starting from zero",
    },
];

const motivations: Choice[] = [
    { value: 'earn_more', emoji: '💰', label: 'Earn more income' },
    { value: 'work_from_home', emoji: '🏠', label: 'Work from home' },
    { value: 'new_career', emoji: '🚀', label: 'Start a new career' },
    { value: 'already_va', emoji: '⭐', label: "I'm already working as a VA" },
];

const challenges: Choice[] = [
    {
        value: 'knowing_expectations',
        emoji: '🎯',
        label: 'Knowing what clients actually expect',
    },
    {
        value: 'talking_to_clients',
        emoji: '💬',
        label: 'Talking to clients professionally',
    },
    {
        value: 'too_many_things',
        emoji: '🤹',
        label: 'Handling too many things at once',
    },
    { value: 'using_ai', emoji: '🤖', label: 'Using AI tools properly' },
];

const TOTAL_STEPS = 8;
const step = ref(0);

const form = useForm<{
    va_skills: string[];
    va_motivation: string;
    va_challenge: string;
}>({
    va_skills: [],
    va_motivation: '',
    va_challenge: '',
});

const progress = computed(() => ((step.value + 1) / TOTAL_STEPS) * 100);

function toggleSkill(value: string): void {
    const isNone = value === 'none_yet';
    const has = form.va_skills.includes(value);

    if (has) {
        form.va_skills = form.va_skills.filter((s) => s !== value);

        return;
    }

    // "None yet" is exclusive with concrete skills.
    if (isNone) {
        form.va_skills = ['none_yet'];
    } else {
        form.va_skills = [
            ...form.va_skills.filter((s) => s !== 'none_yet'),
            value,
        ];
    }
}

function chooseMotivation(value: string): void {
    form.va_motivation = value;
    step.value = 6;
}

function chooseChallenge(value: string): void {
    form.va_challenge = value;
    step.value = 7;
}

function skipIntro(): void {
    step.value = 4;
}

function submit(): void {
    form.post(OnboardingController.store.url());
}
</script>

<template>
    <Head title="Welcome, let's set you up" />

    <div class="flex min-h-screen flex-col bg-background text-foreground">
        <!-- Progress -->
        <div class="mx-auto w-full max-w-xl px-6 pt-8">
            <Progress :model-value="progress" class="h-2" />
        </div>

        <div
            class="mx-auto flex w-full max-w-xl flex-1 flex-col justify-center px-6 py-10"
        >
            <!-- Intro step 0: what is a VA -->
            <section
                v-if="step === 0"
                :key="'i0'"
                class="animate-in space-y-6 duration-300 fade-in slide-in-from-bottom-3"
            >
                <div class="space-y-2 text-center">
                    <p class="text-4xl">🙋</p>
                    <h1 class="font-display text-2xl font-semibold">
                        What is a Virtual Assistant?
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        A VA works remotely for a client, handling the kind of
                        everyday tasks that keep a business running, all from a
                        laptop, anywhere in the Philippines.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <div
                        v-for="task in vaTaskExamples"
                        :key="task.label"
                        class="flex items-start gap-3 rounded-xl border border-border bg-card p-4"
                    >
                        <div
                            class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-primary/10 text-primary"
                        >
                            <component :is="task.icon" class="size-4" />
                        </div>
                        <div class="space-y-0.5">
                            <p class="text-sm font-medium">
                                {{ task.label }}
                            </p>
                            <p class="text-xs text-muted-foreground">
                                {{ task.blurb }}
                            </p>
                        </div>
                    </div>
                </div>

                <Button class="w-full" size="lg" @click="step = 1">
                    Continue
                    <ArrowRight class="size-4" />
                </Button>

                <button
                    type="button"
                    class="mx-auto block text-xs text-muted-foreground underline-offset-2 hover:text-foreground hover:underline"
                    @click="skipIntro"
                >
                    Skip intro
                </button>
            </section>

            <!-- Intro step 1: why Filipinos dominate this industry -->
            <section
                v-else-if="step === 1"
                :key="'i1'"
                class="animate-in space-y-6 duration-300 fade-in slide-in-from-bottom-3"
            >
                <div class="space-y-2 text-center">
                    <p class="text-4xl">🌏</p>
                    <h1 class="font-display text-2xl font-semibold">
                        Filipinos lead this industry
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        This isn't a niche gig, it's one of the biggest remote
                        career paths in the country.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                    <div
                        v-for="stat in vaIndustryStats"
                        :key="stat.label"
                        class="flex flex-col items-center gap-2 rounded-xl border border-border bg-card p-4 text-center"
                    >
                        <div
                            class="flex size-9 items-center justify-center rounded-lg bg-primary/10 text-primary"
                        >
                            <component :is="stat.icon" class="size-4" />
                        </div>
                        <p
                            class="font-display text-xl font-semibold text-foreground"
                        >
                            {{ stat.value }}
                        </p>
                        <p class="text-xs text-muted-foreground">
                            {{ stat.label }}
                        </p>
                    </div>
                </div>

                <Button class="w-full" size="lg" @click="step = 2">
                    Continue
                    <ArrowRight class="size-4" />
                </Button>

                <button
                    type="button"
                    class="mx-auto block text-xs text-muted-foreground underline-offset-2 hover:text-foreground hover:underline"
                    @click="skipIntro"
                >
                    Skip intro
                </button>
            </section>

            <!-- Intro step 2: reassurance for beginners -->
            <section
                v-else-if="step === 2"
                :key="'i2'"
                class="animate-in space-y-6 duration-300 fade-in slide-in-from-bottom-3"
            >
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div
                            class="flex size-8 items-center justify-center rounded-lg bg-primary/10 text-primary"
                        >
                            <Sparkles class="size-5" />
                        </div>
                        <h1 class="font-display text-lg font-semibold">
                            You don't need experience
                        </h1>
                    </div>

                    <div class="space-y-3">
                        <p
                            class="text-sm leading-relaxed text-muted-foreground"
                        >
                            Most VAs start with zero formal background. What
                            clients actually need, clear communication,
                            reliability, and basic computer skills, you already
                            use every day.
                        </p>
                        <p
                            class="text-sm leading-relaxed text-muted-foreground"
                        >
                            That's exactly what this program trains: real client
                            scenarios, so you walk in already knowing what good
                            work looks like.
                        </p>
                    </div>
                </div>

                <LessonTip
                    tip="Beginners typically earn around $15–18/hr in their first 30 days, and can reach $28–35/hr by month six with a few retained clients."
                />

                <Button class="w-full" size="lg" @click="step = 3">
                    Continue
                    <ArrowRight class="size-4" />
                </Button>

                <button
                    type="button"
                    class="mx-auto block text-xs text-muted-foreground underline-offset-2 hover:text-foreground hover:underline"
                    @click="skipIntro"
                >
                    Skip intro
                </button>
            </section>

            <!-- Intro step 3: transition -->
            <section
                v-else-if="step === 3"
                :key="'i3'"
                class="animate-in space-y-8 text-center duration-300 fade-in slide-in-from-bottom-3"
            >
                <div class="space-y-4">
                    <div
                        class="mx-auto flex size-16 items-center justify-center rounded-2xl bg-primary/10 text-primary"
                    >
                        <ArrowRight class="size-8" />
                    </div>
                    <h1 class="font-display text-2xl font-semibold">
                        Let's find your path
                    </h1>
                    <p class="mx-auto max-w-md text-muted-foreground">
                        A few quick questions so we can point you to the right
                        starting task.
                    </p>
                </div>

                <Button class="w-full" size="lg" @click="step = 4">
                    Continue
                    <ArrowRight class="size-4" />
                </Button>
            </section>

            <!-- Step 4: skills (multi-select) -->
            <section
                v-else-if="step === 4"
                :key="'s0'"
                class="animate-in space-y-6 duration-300 fade-in slide-in-from-bottom-3"
            >
                <div class="space-y-2 text-center">
                    <p class="text-4xl">👋</p>
                    <h1 class="font-display text-2xl font-semibold">
                        What skills do you already have?
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        Pick any that fit, or tell us you're starting fresh.
                        Choose one or more.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <button
                        v-for="skill in skills"
                        :key="skill.value"
                        type="button"
                        :class="[
                            'flex items-center gap-3 rounded-xl border p-4 text-left transition-all duration-200 hover:-translate-y-0.5',
                            form.va_skills.includes(skill.value)
                                ? 'border-primary bg-primary/10 ring-1 ring-primary'
                                : 'border-border bg-card hover:border-primary/40',
                        ]"
                        @click="toggleSkill(skill.value)"
                    >
                        <span class="text-2xl">{{ skill.emoji }}</span>
                        <span class="flex-1 text-sm font-medium">{{
                            skill.label
                        }}</span>
                        <Check
                            v-if="form.va_skills.includes(skill.value)"
                            class="size-4 shrink-0 text-primary"
                        />
                    </button>
                </div>

                <Button
                    class="w-full"
                    size="lg"
                    :disabled="form.va_skills.length === 0"
                    @click="step = 5"
                >
                    Continue
                    <ArrowRight class="size-4" />
                </Button>
            </section>

            <!-- Step 5: motivation (tap advances) -->
            <section
                v-else-if="step === 5"
                :key="'s1'"
                class="animate-in space-y-6 duration-300 fade-in slide-in-from-bottom-3"
            >
                <div class="space-y-2 text-center">
                    <p class="text-4xl">✨</p>
                    <h1 class="font-display text-2xl font-semibold">
                        Why do you want to become a VA?
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        Tap the one that fits best.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-3">
                    <button
                        v-for="motivation in motivations"
                        :key="motivation.value"
                        type="button"
                        class="flex items-center gap-3 rounded-xl border border-border bg-card p-4 text-left transition-all duration-200 hover:-translate-y-0.5 hover:border-primary/40"
                        @click="chooseMotivation(motivation.value)"
                    >
                        <span class="text-2xl">{{ motivation.emoji }}</span>
                        <span class="flex-1 text-sm font-medium">{{
                            motivation.label
                        }}</span>
                        <ArrowRight
                            class="size-4 shrink-0 text-muted-foreground"
                        />
                    </button>
                </div>
            </section>

            <!-- Step 6: challenge (tap advances) -->
            <section
                v-else-if="step === 6"
                :key="'s2'"
                class="animate-in space-y-6 duration-300 fade-in slide-in-from-bottom-3"
            >
                <div class="space-y-2 text-center">
                    <p class="text-4xl">🧭</p>
                    <h1 class="font-display text-2xl font-semibold">
                        What's your biggest challenge right now?
                    </h1>
                    <p class="text-sm text-muted-foreground">
                        This decides where you start.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-3">
                    <button
                        v-for="challenge in challenges"
                        :key="challenge.value"
                        type="button"
                        class="flex items-center gap-3 rounded-xl border border-border bg-card p-4 text-left transition-all duration-200 hover:-translate-y-0.5 hover:border-primary/40"
                        @click="chooseChallenge(challenge.value)"
                    >
                        <span class="text-2xl">{{ challenge.emoji }}</span>
                        <span class="flex-1 text-sm font-medium">{{
                            challenge.label
                        }}</span>
                        <ArrowRight
                            class="size-4 shrink-0 text-muted-foreground"
                        />
                    </button>
                </div>
            </section>

            <!-- Step 7: the promise -->
            <section
                v-else
                :key="'s3'"
                class="animate-in space-y-8 text-center duration-300 fade-in slide-in-from-bottom-3"
            >
                <div class="space-y-4">
                    <div
                        class="glow-primary mx-auto flex size-16 items-center justify-center rounded-2xl bg-primary/10 text-primary"
                    >
                        <Sparkles class="size-8" />
                    </div>
                    <h1 class="font-display text-2xl font-semibold">
                        Here's what you'll prove
                    </h1>
                    <p class="mx-auto max-w-md text-muted-foreground">
                        In this program you'll prove you can handle real client
                        work, use AI the way clients expect, and know what good
                        looks like, by doing it instead of just watching.
                    </p>
                </div>

                <Button
                    class="w-full"
                    size="lg"
                    :disabled="form.processing"
                    @click="submit"
                >
                    <Spinner v-if="form.processing" />
                    Start my first task
                    <ArrowRight v-if="!form.processing" class="size-4" />
                </Button>
            </section>
        </div>
    </div>
</template>
