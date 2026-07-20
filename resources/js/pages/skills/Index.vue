<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { BookOpen, CircleCheckBig, Lock, Sparkles } from '@lucide/vue';
import { computed } from 'vue';
import { show as courseShow } from '@/actions/App/Http/Controllers/SkillCourseController';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent } from '@/components/ui/card';
import { dashboard } from '@/routes';
import type { IndexCourse } from '@/types/skills';

const props = defineProps<{
    courses: IndexCourse[];
    foundationComplete: boolean;
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Courses', href: dashboard() }],
    },
});

const locked = computed(() => !props.foundationComplete);
const recommended = computed(() => props.courses.filter((c) => c.recommended));
const others = computed(() => props.courses.filter((c) => !c.recommended));
</script>

<template>
    <Head title="Courses" />

    <div class="mx-auto flex w-full max-w-4xl flex-1 flex-col gap-8 p-4">
        <div
            class="flex animate-in flex-col gap-1 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <h1 class="font-display text-2xl font-semibold text-foreground">
                Skill courses
            </h1>
            <p class="text-sm text-muted-foreground">
                Practice real VA deliverables and get them reviewed. The ones
                matched to your skills are highlighted.
            </p>
        </div>

        <Alert
            v-if="locked"
            class="animate-in border-primary/30 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <Lock class="size-4" />
            <AlertTitle>Finish the Foundation first</AlertTitle>
            <AlertDescription>
                These courses unlock once you've finished the entire Foundation
                track. Keep going, you'll be here soon.
            </AlertDescription>
        </Alert>

        <section v-if="recommended.length" class="space-y-3">
            <div class="flex items-center gap-2">
                <Sparkles class="size-4 text-primary" />
                <h2
                    class="font-display text-sm font-semibold tracking-wide text-foreground uppercase"
                >
                    Recommended for you
                </h2>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <component
                    :is="locked ? 'div' : Link"
                    v-for="course in recommended"
                    :key="course.skillKey"
                    :href="
                        locked
                            ? undefined
                            : courseShow.url({ course: course.skillKey })
                    "
                    :aria-disabled="locked || undefined"
                >
                    <Card
                        :class="[
                            'h-full border-primary/30 transition-all duration-200',
                            locked
                                ? 'cursor-not-allowed opacity-60'
                                : 'hover:-translate-y-0.5 hover:shadow-lg',
                        ]"
                    >
                        <CardContent class="space-y-2">
                            <div
                                class="flex items-center justify-between gap-2"
                            >
                                <div
                                    class="flex size-9 items-center justify-center rounded-lg bg-primary/10 text-primary"
                                >
                                    <BookOpen class="size-5" />
                                </div>
                                <Badge v-if="locked" variant="secondary">
                                    <Lock class="size-3" />
                                    Locked
                                </Badge>
                                <Badge
                                    v-else-if="course.completed"
                                    variant="secondary"
                                >
                                    <CircleCheckBig
                                        class="size-3 text-success"
                                    />
                                    Done
                                </Badge>
                            </div>
                            <h3
                                class="font-display text-base font-semibold text-foreground"
                            >
                                {{ course.title }}
                            </h3>
                            <p class="text-sm text-muted-foreground">
                                {{ course.subtitle }}
                            </p>
                            <p class="text-xs text-muted-foreground">
                                {{ course.lessonCount }} lessons
                            </p>
                        </CardContent>
                    </Card>
                </component>
            </div>
        </section>

        <section class="space-y-3">
            <h2
                v-if="recommended.length"
                class="font-display text-sm font-semibold tracking-wide text-muted-foreground uppercase"
            >
                All courses
            </h2>
            <div class="grid gap-3 sm:grid-cols-2">
                <component
                    :is="locked ? 'div' : Link"
                    v-for="course in others"
                    :key="course.skillKey"
                    :href="
                        locked
                            ? undefined
                            : courseShow.url({ course: course.skillKey })
                    "
                    :aria-disabled="locked || undefined"
                >
                    <Card
                        :class="[
                            'h-full transition-all duration-200',
                            locked
                                ? 'cursor-not-allowed opacity-60'
                                : 'hover:-translate-y-0.5 hover:shadow-lg',
                        ]"
                    >
                        <CardContent class="space-y-2">
                            <div
                                class="flex items-center justify-between gap-2"
                            >
                                <div
                                    class="flex size-9 items-center justify-center rounded-lg bg-muted text-muted-foreground"
                                >
                                    <BookOpen class="size-5" />
                                </div>
                                <Badge v-if="locked" variant="secondary">
                                    <Lock class="size-3" />
                                    Locked
                                </Badge>
                                <Badge
                                    v-else-if="course.completed"
                                    variant="secondary"
                                >
                                    <CircleCheckBig
                                        class="size-3 text-success"
                                    />
                                    Done
                                </Badge>
                            </div>
                            <h3
                                class="font-display text-base font-semibold text-foreground"
                            >
                                {{ course.title }}
                            </h3>
                            <p class="text-sm text-muted-foreground">
                                {{ course.subtitle }}
                            </p>
                            <p class="text-xs text-muted-foreground">
                                {{ course.lessonCount }} lessons
                            </p>
                        </CardContent>
                    </Card>
                </component>
            </div>
        </section>
    </div>
</template>
