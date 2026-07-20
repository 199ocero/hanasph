import { markRaw } from 'vue';
import { toast } from 'vue-sonner';
import AchievementToast from '@/components/AchievementToast.vue';
import type { Rarity } from '@/types';

type AchievementUnlockedPayload = {
    title: string;
    rarity: Rarity;
};

export function notifyAchievementUnlocked(
    payload: AchievementUnlockedPayload,
): void {
    toast.custom(markRaw(AchievementToast), {
        componentProps: payload,
        duration: 5000,
    });
}
