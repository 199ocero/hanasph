<script setup lang="ts">
import { computed } from 'vue';
import type { PresenceStatus } from '@/types';

type Props = {
    status: PresenceStatus;
};

const props = defineProps<Props>();

const colorClass = computed(
    () =>
        ({
            online: 'bg-presence-online',
            idle: 'bg-presence-idle',
            dnd: 'bg-presence-dnd',
            offline: 'bg-presence-offline',
        })[props.status],
);
</script>

<template>
    <span
        class="block size-2.5 rounded-full ring-2 ring-background"
        :class="colorClass"
        :aria-label="`Status: ${status}`"
    />
</template>
