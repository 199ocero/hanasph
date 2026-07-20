<script setup lang="ts">
import AchievementCard from '@/components/AchievementCard.vue';
import type { Achievement } from '@/types';

type Props = {
    achievements: Achievement[];
};

defineProps<Props>();
</script>

<template>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
        <AchievementCard
            v-for="achievement in achievements"
            :key="achievement.title"
            :achievement="achievement"
        />
    </div>
</template>
