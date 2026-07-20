<script setup lang="ts">
import { computed } from 'vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import { useInitials } from '@/composables/useInitials';

type StackUser = {
    name: string;
    avatar?: string;
};

type Props = {
    users: StackUser[];
    max?: number;
};

const props = withDefaults(defineProps<Props>(), {
    max: 5,
});

const { getInitials } = useInitials();

const visible = computed(() => props.users.slice(0, props.max));
const overflow = computed(() => Math.max(0, props.users.length - props.max));
</script>

<template>
    <div class="flex items-center -space-x-2">
        <Avatar
            v-for="user in visible"
            :key="user.name"
            class="ring-2 ring-background"
        >
            <AvatarImage
                v-if="user.avatar"
                :src="user.avatar"
                :alt="user.name"
            />
            <AvatarFallback>{{ getInitials(user.name) }}</AvatarFallback>
        </Avatar>
        <div
            v-if="overflow > 0"
            class="flex size-8 items-center justify-center rounded-full bg-muted text-xs font-medium text-muted-foreground ring-2 ring-background"
        >
            +{{ overflow }}
        </div>
    </div>
</template>
