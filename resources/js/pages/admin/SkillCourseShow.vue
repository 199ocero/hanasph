<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { NotebookText } from '@lucide/vue';
import { index as adminIndex } from '@/actions/App/Http/Controllers/Admin/DashboardController';
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import type { AdminSkillCourse, AdminSkillLesson } from '@/types/admin';

defineProps<{
    course: AdminSkillCourse;
    lessons: AdminSkillLesson[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Admin', href: adminIndex.url() }],
    },
});
</script>

<template>
    <Head :title="`Admin: ${course.title}`" />

    <div class="mx-auto flex w-full max-w-2xl flex-1 flex-col gap-6 p-4">
        <div
            class="flex animate-in flex-col gap-2 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <Link
                :href="adminIndex.url()"
                class="text-xs text-muted-foreground hover:text-foreground"
            >
                &larr; Admin
            </Link>
            <h1 class="font-display text-xl font-semibold text-foreground">
                {{ course.title }}
            </h1>
            <p v-if="course.subtitle" class="text-sm text-muted-foreground">
                {{ course.subtitle }}
            </p>
            <div class="flex flex-wrap items-center gap-2">
                <Badge :variant="course.isPublished ? 'default' : 'outline'">
                    {{ course.isPublished ? 'Published' : 'Draft' }}
                </Badge>
                <Badge variant="secondary">{{ course.source }}</Badge>
            </div>
        </div>

        <div
            v-for="lesson in lessons"
            :key="lesson.id"
            class="animate-in space-y-3 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <Card>
                <CardHeader>
                    <div class="flex items-start justify-between gap-2">
                        <CardTitle class="text-base">
                            {{ lesson.order }}. {{ lesson.title }}
                        </CardTitle>
                        <Badge
                            :variant="
                                lesson.isPublished ? 'default' : 'outline'
                            "
                        >
                            {{ lesson.isPublished ? 'Published' : 'Draft' }}
                        </Badge>
                    </div>
                    <p class="text-sm text-muted-foreground">
                        {{ lesson.brief }}
                    </p>
                    <div class="flex flex-wrap items-center gap-2">
                        <Badge variant="outline">{{ lesson.difficulty }}</Badge>
                        <Badge variant="outline"
                            >{{ lesson.xpReward }} XP</Badge
                        >
                        <Badge
                            v-for="format in lesson.acceptedFormats"
                            :key="format"
                            variant="secondary"
                        >
                            {{ format }}
                        </Badge>
                    </div>
                </CardHeader>
                <CardContent class="space-y-4">
                    <p v-if="lesson.tip" class="text-xs text-muted-foreground">
                        <span class="font-medium">Tip:</span> {{ lesson.tip }}
                    </p>

                    <div v-if="lesson.rubric.length" class="space-y-2">
                        <p
                            class="text-xs font-medium tracking-wide text-muted-foreground uppercase"
                        >
                            Rubric
                        </p>
                        <div
                            v-for="(criterion, index) in lesson.rubric"
                            :key="index"
                            class="rounded-lg border border-border bg-muted/20 p-3 text-sm"
                        >
                            <div class="flex items-start justify-between gap-2">
                                <p class="font-medium text-foreground">
                                    {{ criterion.criterion }}
                                </p>
                                <Badge variant="outline" class="shrink-0">
                                    {{ criterion.weight }}%
                                </Badge>
                            </div>
                            <p class="mt-1 text-xs text-muted-foreground">
                                {{ criterion.what_good_looks_like }}
                            </p>
                        </div>
                    </div>

                    <Alert v-if="lesson.referenceNotes">
                        <NotebookText class="size-4" />
                        <AlertTitle>Model answer notes</AlertTitle>
                        <AlertDescription>
                            {{ lesson.referenceNotes }}
                        </AlertDescription>
                    </Alert>
                </CardContent>
            </Card>
        </div>
    </div>
</template>
