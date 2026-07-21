<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import TaskController from '@/actions/App/Http/Controllers/TaskController';
import { cn } from '@/lib/utils';

const props = defineProps<{
    current: number;
    total: number;
    taskSlug?: string;
    interactive?: boolean;
}>();

const beats = computed(() =>
    Array.from({ length: props.total }, (_, i) => i + 1),
);

const dotClass = (beat: number) =>
    cn(
        'h-1.5 rounded-full transition-all duration-300',
        beat < props.current && 'w-6 bg-success',
        beat === props.current && 'w-6 bg-primary',
        beat > props.current && 'w-3 bg-border',
    );
</script>

<template>
    <div class="flex items-center gap-1.5">
        <template v-if="interactive && taskSlug">
            <Link
                v-for="beat in beats"
                :key="beat"
                :href="
                    TaskController.show.url(taskSlug, {
                        query: { beat },
                    })
                "
                :class="dotClass(beat)"
            />
        </template>
        <template v-else>
            <span v-for="beat in beats" :key="beat" :class="dotClass(beat)" />
        </template>
    </div>
</template>
