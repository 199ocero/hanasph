<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { CircleCheckBig, Lock, Play } from '@lucide/vue';
import { show as lessonShow } from '@/actions/App/Http/Controllers/SkillLessonController';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent } from '@/components/ui/card';
import { dashboard } from '@/routes';
import type { CourseLesson } from '@/types/skills';

const props = defineProps<{
    course: {
        skillKey: string;
        title: string;
        subtitle: string | null;
        icon: string | null;
    };
    lessons: CourseLesson[];
    progress: { currentLessonOrder: number; completed: boolean };
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Courses', href: dashboard() }],
    },
});

const difficultyLabel: Record<string, string> = {
    easy: 'Easy',
    medium: 'Medium',
    hard: 'Hard',
};

function lessonHref(lesson: CourseLesson): string {
    return lessonShow.url({ course: props.course.skillKey, lesson: lesson.id });
}
</script>

<template>
    <Head :title="course.title" />

    <div class="mx-auto flex w-full max-w-2xl flex-1 flex-col gap-6 p-4">
        <div
            class="flex animate-in flex-col gap-1 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <div class="flex items-center gap-2">
                <h1 class="font-display text-2xl font-semibold text-foreground">
                    {{ course.title }}
                </h1>
                <Badge v-if="progress.completed" variant="secondary">
                    <CircleCheckBig class="size-3 text-success" />
                    Completed
                </Badge>
            </div>
            <p v-if="course.subtitle" class="text-sm text-muted-foreground">
                {{ course.subtitle }}
            </p>
        </div>

        <div class="space-y-3">
            <component
                :is="lesson.state === 'locked' ? 'div' : Link"
                v-for="(lesson, index) in lessons"
                :key="lesson.id"
                :href="
                    lesson.state === 'locked' ? undefined : lessonHref(lesson)
                "
                class="block animate-in duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
                :style="{ animationDelay: `${index * 60}ms` }"
            >
                <Card
                    :class="[
                        lesson.state === 'locked'
                            ? 'opacity-60'
                            : 'transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg',
                        lesson.state === 'current' ? 'border-primary/40' : '',
                    ]"
                >
                    <CardContent class="flex items-center gap-4">
                        <div
                            class="flex size-10 shrink-0 items-center justify-center rounded-full"
                            :class="{
                                'bg-success/15 text-success':
                                    lesson.state === 'passed',
                                'bg-primary/15 text-primary':
                                    lesson.state === 'current',
                                'bg-muted text-muted-foreground':
                                    lesson.state === 'locked',
                            }"
                        >
                            <CircleCheckBig
                                v-if="lesson.state === 'passed'"
                                class="size-5"
                            />
                            <Play
                                v-else-if="lesson.state === 'current'"
                                class="size-5"
                            />
                            <Lock v-else class="size-5" />
                        </div>
                        <div class="min-w-0 flex-1">
                            <p
                                class="font-display text-sm font-semibold text-foreground"
                            >
                                {{ lesson.title }}
                            </p>
                            <p class="text-xs text-muted-foreground">
                                {{
                                    difficultyLabel[lesson.difficulty] ??
                                    lesson.difficulty
                                }}
                                · {{ lesson.xpReward }} XP
                            </p>
                        </div>
                    </CardContent>
                </Card>
            </component>
        </div>
    </div>
</template>
