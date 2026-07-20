<script setup lang="ts">
import { computed } from 'vue';
import { Progress } from '@/components/ui/progress';

type Props = {
    current: number;
    max: number;
    label?: string;
};

const props = defineProps<Props>();

const percentage = computed(() =>
    Math.min(100, Math.round((props.current / props.max) * 100)),
);
const isNearComplete = computed(() => percentage.value >= 90);
</script>

<template>
    <div class="w-full space-y-1.5">
        <div v-if="label" class="flex items-center justify-between text-sm">
            <span class="font-medium text-foreground">{{ label }}</span>
            <span class="font-display text-muted-foreground">
                {{ current.toLocaleString() }} / {{ max.toLocaleString() }} XP
            </span>
        </div>
        <Progress
            :model-value="percentage"
            class="h-2.5"
            :class="isNearComplete && 'glow-gold'"
        />
    </div>
</template>
