<script setup lang="ts">
import { computed } from 'vue';

type Props = {
    level: number;
    progress: number;
    size?: 'sm' | 'md' | 'lg';
};

const props = withDefaults(defineProps<Props>(), {
    size: 'md',
});

const dimensions = {
    sm: { box: 40, stroke: 3, font: 'text-[10px]' },
    md: { box: 56, stroke: 3.5, font: 'text-xs' },
    lg: { box: 88, stroke: 4, font: 'text-lg' },
} as const;

const dim = computed(() => dimensions[props.size]);
const radius = computed(() => dim.value.box / 2 - dim.value.stroke * 2);
const circumference = computed(() => 2 * Math.PI * radius.value);
const clampedProgress = computed(() =>
    Math.min(Math.max(props.progress, 0), 100),
);
const offset = computed(
    () => circumference.value * (1 - clampedProgress.value / 100),
);
const isComplete = computed(() => clampedProgress.value >= 100);
</script>

<template>
    <div
        class="relative inline-flex shrink-0 items-center justify-center rounded-full"
        :class="isComplete && 'glow-primary'"
        :style="{ width: `${dim.box}px`, height: `${dim.box}px` }"
    >
        <svg
            class="absolute inset-0 -rotate-90"
            :width="dim.box"
            :height="dim.box"
        >
            <circle
                :cx="dim.box / 2"
                :cy="dim.box / 2"
                :r="radius"
                fill="none"
                stroke="var(--sidebar-accent)"
                :stroke-width="dim.stroke"
            />
            <circle
                :cx="dim.box / 2"
                :cy="dim.box / 2"
                :r="radius"
                fill="none"
                stroke="var(--primary)"
                stroke-linecap="round"
                :stroke-width="dim.stroke"
                :stroke-dasharray="circumference"
                :stroke-dashoffset="offset"
                class="transition-[stroke-dashoffset] duration-500"
            />
        </svg>
        <div
            class="flex items-center justify-center overflow-hidden rounded-full bg-card"
            :style="{
                width: `${dim.box - dim.stroke * 4}px`,
                height: `${dim.box - dim.stroke * 4}px`,
            }"
        >
            <slot>
                <span
                    class="font-display font-semibold text-foreground"
                    :class="dim.font"
                >
                    {{ level }}
                </span>
            </slot>
        </div>
    </div>
</template>
