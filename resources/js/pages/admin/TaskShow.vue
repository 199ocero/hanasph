<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { CheckCircle2, Sparkles, XCircle } from '@lucide/vue';
import { index as adminIndex } from '@/actions/App/Http/Controllers/Admin/DashboardController';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { cn } from '@/lib/utils';
import type { AdminBeat, AdminTask } from '@/types/admin';

defineProps<{
    task: AdminTask;
    beats: AdminBeat[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Admin', href: adminIndex.url() }],
    },
});
</script>

<template>
    <Head :title="`Admin: ${task.title}`" />

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
                {{ task.title }}
            </h1>
            <p class="text-sm text-muted-foreground">
                {{ task.scenarioIntro }}
            </p>
            <div class="flex flex-wrap items-center gap-2">
                <Badge variant="secondary">{{ task.category }}</Badge>
                <Badge
                    v-if="task.aiGradingEnabled"
                    variant="outline"
                    class="gap-1 border-primary/30 text-primary"
                >
                    <Sparkles class="size-3" />
                    AI graded
                </Badge>
                <Badge variant="outline">{{ task.xpReward }} XP</Badge>
            </div>
        </div>

        <Card
            class="animate-in delay-75 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <CardContent>
                <p class="text-sm text-muted-foreground">
                    <span class="font-medium text-foreground">Persona:</span>
                    {{ task.clientPersona }}
                </p>
            </CardContent>
        </Card>

        <div
            v-for="beat in beats"
            :key="beat.id"
            class="animate-in space-y-3 duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <Card>
                <CardHeader>
                    <CardTitle class="text-base">
                        Beat {{ beat.order }}
                    </CardTitle>
                    <p class="text-sm text-muted-foreground">
                        {{ beat.clientMessage }}
                    </p>
                </CardHeader>
                <CardContent class="space-y-3">
                    <p
                        v-if="beat.scaffoldHint"
                        class="text-xs text-muted-foreground"
                    >
                        <span class="font-medium">Scaffold hint:</span>
                        {{ beat.scaffoldHint }}
                    </p>
                    <p
                        v-if="beat.tagalogTip"
                        class="text-xs text-muted-foreground"
                    >
                        <span class="font-medium">Tagalog tip:</span>
                        {{ beat.tagalogTip }}
                    </p>

                    <div
                        v-for="option in beat.options"
                        :key="option.id"
                        :class="
                            cn(
                                'space-y-2 rounded-xl border p-3',
                                option.isCorrect
                                    ? 'border-success/40 bg-success/10'
                                    : 'border-border bg-muted/20',
                            )
                        "
                    >
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm text-foreground">
                                {{ option.body }}
                            </p>
                            <Badge
                                v-if="option.isCorrect"
                                class="shrink-0 gap-1 border-success/40 bg-success/20 text-success"
                                variant="outline"
                            >
                                <CheckCircle2 class="size-3" />
                                Correct
                            </Badge>
                            <Badge
                                v-else
                                class="shrink-0 gap-1"
                                variant="outline"
                            >
                                <XCircle class="size-3" />
                                Wrong
                            </Badge>
                        </div>
                        <p
                            v-if="option.diagnostic"
                            class="text-xs leading-relaxed text-muted-foreground"
                        >
                            {{ option.diagnostic }}
                        </p>
                        <div
                            v-if="option.lesson"
                            class="rounded-lg border border-border bg-card p-2 text-xs"
                        >
                            <p class="font-medium text-foreground">
                                Lesson: {{ option.lesson.title }}
                            </p>
                            <p class="text-muted-foreground">
                                {{ option.lesson.body }}
                            </p>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </div>
</template>
