<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    Bot,
    Check,
    ClipboardList,
    Compass,
    Lock,
    MessageSquare,
    ListChecks,
} from '@lucide/vue';
import type { LucideIcon } from '@lucide/vue';
import { computed } from 'vue';
import TaskController from '@/actions/App/Http/Controllers/TaskController';
import { cn } from '@/lib/utils';
import type { TrackNode } from '@/types/tasks';

const props = defineProps<{
    node: TrackNode;
}>();

const categoryIcons: Record<string, LucideIcon> = {
    intro: Compass,
    comms: MessageSquare,
    prioritization: ListChecks,
    ai: Bot,
    admin: ClipboardList,
};

const isLocked = computed(() => props.node.status === 'locked');
const isPassed = computed(() => props.node.status === 'passed');
const isPlayable = computed(() => !isLocked.value);

const icon = computed<LucideIcon>(() => {
    if (isPassed.value) {
        return Check;
    }

    if (isLocked.value) {
        return Lock;
    }

    return categoryIcons[props.node.category] ?? MessageSquare;
});
</script>

<template>
    <component
        :is="isPlayable ? Link : 'div'"
        :href="isPlayable ? TaskController.show(node.slug) : undefined"
        :aria-disabled="isLocked || undefined"
        :class="
            cn(
                'group flex items-center gap-4 rounded-xl border border-border bg-card p-4 transition-all duration-200',
                isPlayable &&
                    'hover:-translate-y-0.5 hover:border-primary/40 hover:shadow-lg',
                isLocked && 'cursor-not-allowed border-border/60',
                node.isCurrent && 'glow-primary border-primary/50',
            )
        "
    >
        <!-- Status marker -->
        <div
            :class="
                cn(
                    'flex size-11 shrink-0 items-center justify-center rounded-full border-2 transition-colors',
                    isPassed && 'border-success bg-success/15 text-success',
                    node.isCurrent &&
                        'animate-glow-primary border-primary bg-primary/15 text-primary',
                    !isPassed &&
                        !node.isCurrent &&
                        !isLocked &&
                        'border-border bg-secondary text-foreground',
                    isLocked &&
                        'border-border/60 bg-muted text-muted-foreground',
                )
            "
        >
            <component :is="icon" :class="cn('size-5', isLocked && 'grayscale')" />
        </div>

        <!-- Title + persona -->
        <div class="min-w-0 flex-1">
            <div class="flex items-center gap-2">
                <span
                    class="font-display text-xs font-semibold tracking-wide text-muted-foreground uppercase"
                >
                    Task {{ node.order }}
                </span>
                <span
                    v-if="node.isCurrent"
                    class="rounded-full bg-primary/15 px-2 py-0.5 text-[10px] font-semibold tracking-wide text-primary uppercase"
                >
                    Current
                </span>
            </div>
            <p
                :class="
                    cn(
                        'truncate font-medium',
                        isLocked ? 'text-muted-foreground' : 'text-foreground',
                    )
                "
            >
                {{ isLocked ? 'Locked' : node.title }}
            </p>
            <p v-if="!isLocked" class="truncate text-xs text-muted-foreground">
                {{ node.clientPersona }}
            </p>
        </div>
    </component>
</template>
