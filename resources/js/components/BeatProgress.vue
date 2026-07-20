<script setup lang="ts">
import { computed } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    current: number;
    total: number;
}>();

const beats = computed(() =>
    Array.from({ length: props.total }, (_, i) => i + 1),
);
</script>

<template>
    <div class="flex items-center gap-1.5">
        <span
            v-for="beat in beats"
            :key="beat"
            :class="
                cn(
                    'h-1.5 rounded-full transition-all duration-300',
                    beat < current && 'w-6 bg-success',
                    beat === current && 'w-6 bg-primary',
                    beat > current && 'w-3 bg-border',
                )
            "
        />
    </div>
</template>
