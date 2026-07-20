<script setup lang="ts">
import OptionCard from '@/components/OptionCard.vue';
import { Button } from '@/components/ui/button';
import { Spinner } from '@/components/ui/spinner';
import type { PlayerOption } from '@/types/tasks';

const props = defineProps<{
    options: PlayerOption[];
    selectedId: number | null;
    /** Options are locked while a diagnostic is showing. */
    locked: boolean;
    processing: boolean;
    /** The wrong option currently being explained, if any. */
    wrongId: number | null;
}>();

const emit = defineEmits<{
    'update:selectedId': [id: number];
    submit: [];
}>();
</script>

<template>
    <div class="space-y-3">
        <OptionCard
            v-for="option in options"
            :key="option.id"
            :option="option"
            :selected="selectedId === option.id"
            :disabled="locked || processing"
            :wrong="wrongId === option.id"
            @select="emit('update:selectedId', $event)"
        />

        <Button
            v-if="!locked"
            type="button"
            class="w-full"
            size="lg"
            :disabled="selectedId === null || processing"
            @click="emit('submit')"
        >
            <Spinner v-if="processing" />
            Send reply
        </Button>
    </div>
</template>
