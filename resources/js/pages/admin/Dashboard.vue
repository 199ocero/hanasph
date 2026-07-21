<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Sparkles } from '@lucide/vue';
import { show as skillShow } from '@/actions/App/Http/Controllers/Admin/AdminSkillCourseController';
import { show as taskShow } from '@/actions/App/Http/Controllers/Admin/AdminTaskController';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { dashboard } from '@/routes';
import type { AdminCourseSummary, AdminTaskSummary } from '@/types/admin';

defineProps<{
    tasks: AdminTaskSummary[];
    courses: AdminCourseSummary[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Admin', href: dashboard() }],
    },
});
</script>

<template>
    <Head title="Admin" />

    <div class="mx-auto flex w-full max-w-4xl flex-1 flex-col gap-8 p-4">
        <div
            class="flex animate-in flex-col gap-1 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <h1 class="font-display text-2xl font-semibold text-foreground">
                Admin
            </h1>
            <p class="text-sm text-muted-foreground">
                Browse every question and its answer key without having to play
                through it.
            </p>
        </div>

        <Card
            class="animate-in delay-75 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <CardHeader>
                <CardTitle>Foundation tasks</CardTitle>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-12">#</TableHead>
                            <TableHead>Title</TableHead>
                            <TableHead>Category</TableHead>
                            <TableHead>Grading</TableHead>
                            <TableHead class="text-right">Beats</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow
                            v-for="task in tasks"
                            :key="task.slug"
                            class="cursor-pointer"
                        >
                            <TableCell class="text-muted-foreground">
                                {{ task.order }}
                            </TableCell>
                            <TableCell>
                                <Link
                                    :href="taskShow.url({ task: task.slug })"
                                    class="font-medium text-foreground hover:text-primary"
                                >
                                    {{ task.title }}
                                </Link>
                            </TableCell>
                            <TableCell>
                                <Badge variant="secondary">{{
                                    task.category
                                }}</Badge>
                            </TableCell>
                            <TableCell>
                                <Badge
                                    v-if="task.aiGradingEnabled"
                                    variant="outline"
                                    class="gap-1 border-primary/30 text-primary"
                                >
                                    <Sparkles class="size-3" />
                                    AI graded
                                </Badge>
                                <Badge v-else variant="outline">
                                    Multiple choice
                                </Badge>
                            </TableCell>
                            <TableCell class="text-right text-muted-foreground">
                                {{ task.beatsCount }}
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </CardContent>
        </Card>

        <Card
            class="animate-in delay-150 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <CardHeader>
                <CardTitle>Skill courses</CardTitle>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Title</TableHead>
                            <TableHead>Subtitle</TableHead>
                            <TableHead>Status</TableHead>
                            <TableHead class="text-right">Lessons</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow
                            v-for="course in courses"
                            :key="course.skillKey"
                            class="cursor-pointer"
                        >
                            <TableCell>
                                <Link
                                    :href="
                                        skillShow.url({
                                            course: course.skillKey,
                                        })
                                    "
                                    class="font-medium text-foreground hover:text-primary"
                                >
                                    {{ course.title }}
                                </Link>
                            </TableCell>
                            <TableCell class="text-muted-foreground">
                                {{ course.subtitle ?? 'No subtitle' }}
                            </TableCell>
                            <TableCell>
                                <Badge
                                    :variant="
                                        course.isPublished
                                            ? 'default'
                                            : 'outline'
                                    "
                                >
                                    {{
                                        course.isPublished
                                            ? 'Published'
                                            : 'Draft'
                                    }}
                                </Badge>
                            </TableCell>
                            <TableCell class="text-right text-muted-foreground">
                                {{ course.lessonsCount }}
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    </div>
</template>
