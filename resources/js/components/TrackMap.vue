<script setup lang="ts">
import TrackNode from '@/components/TrackNode.vue';
import type { TrackNode as TrackNodeType } from '@/types/tasks';

defineProps<{
    nodes: TrackNodeType[];
}>();
</script>

<template>
    <ol class="relative space-y-3">
        <!-- Connecting spine -->
        <span
            aria-hidden="true"
            class="absolute top-4 bottom-4 left-[1.85rem] w-px bg-border"
        />
        <li v-for="node in nodes" :key="node.order" class="relative">
            <TrackNode :node="node" />
        </li>
    </ol>
</template>
