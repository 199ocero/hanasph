<script setup lang="ts">
import QuestItem from '@/components/QuestItem.vue';
import type { Quest } from '@/types';

type Props = {
    quests: Quest[];
};

defineProps<Props>();
</script>

<template>
    <div class="space-y-3">
        <QuestItem v-for="quest in quests" :key="quest.title" :quest="quest" />
    </div>
</template>
