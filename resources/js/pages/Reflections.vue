<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {
    Bot,
    ClipboardList,
    ListChecks,
    MessageSquare,
    NotebookPen,
} from '@lucide/vue';
import type { LucideIcon } from '@lucide/vue';
import Heading from '@/components/Heading.vue';
import { Card, CardContent } from '@/components/ui/card';
import reflectionRoutes from '@/routes/reflections';

defineProps<{
    reflections: {
        taskTitle: string;
        category: string;
        note: string;
        reflectedAt: string | null;
    }[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Reflections', href: reflectionRoutes.index() }],
    },
});

const categoryIcons: Record<string, LucideIcon> = {
    comms: MessageSquare,
    prioritization: ListChecks,
    ai: Bot,
    admin: ClipboardList,
};

function iconFor(category: string): LucideIcon {
    return categoryIcons[category] ?? MessageSquare;
}

function formatDate(iso: string | null): string {
    if (!iso) {
        return '';
    }

    return new Date(iso).toLocaleDateString(undefined, {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
    });
}
</script>

<template>
    <Head title="Reflections" />

    <div class="mx-auto flex w-full max-w-2xl flex-1 flex-col gap-6 p-4">
        <Heading
            variant="small"
            title="Reflections"
            description="What you've taken away after each task you've passed."
        />

        <div
            v-if="reflections.length === 0"
            class="animate-in duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
        >
            <Card>
                <CardContent
                    class="flex flex-col items-center gap-2 py-10 text-center"
                >
                    <NotebookPen class="size-8 text-muted-foreground" />
                    <p class="text-sm text-muted-foreground">
                        Pass a task and jot down a quick reflection. It'll show
                        up here.
                    </p>
                </CardContent>
            </Card>
        </div>

        <div v-else class="flex flex-col gap-3">
            <Card
                v-for="(reflection, index) in reflections"
                :key="index"
                class="animate-in duration-500 fill-mode-both fade-in slide-in-from-bottom-2"
            >
                <CardContent class="space-y-2">
                    <div class="flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2">
                            <component
                                :is="iconFor(reflection.category)"
                                class="size-4 text-primary"
                            />
                            <h3
                                class="font-display text-sm font-semibold text-foreground"
                            >
                                {{ reflection.taskTitle }}
                            </h3>
                        </div>
                        <span class="text-xs text-muted-foreground">{{
                            formatDate(reflection.reflectedAt)
                        }}</span>
                    </div>
                    <p class="text-sm leading-relaxed text-muted-foreground">
                        {{ reflection.note }}
                    </p>
                </CardContent>
            </Card>
        </div>
    </div>
</template>
