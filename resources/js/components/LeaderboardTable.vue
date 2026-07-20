<script setup lang="ts">
import { ArrowDown, ArrowUp, Minus } from '@lucide/vue';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { useInitials } from '@/composables/useInitials';
import type { LeaderboardEntry } from '@/types';

type Props = {
    entries: LeaderboardEntry[];
};

defineProps<Props>();

const { getInitials } = useInitials();

function rankColor(rank: number): string {
    if (rank === 1) {
        return 'text-gold';
    }

    if (rank === 2) {
        return 'text-rarity-common';
    }

    if (rank === 3) {
        return 'text-warning';
    }

    return 'text-muted-foreground';
}
</script>

<template>
    <Table>
        <TableHeader>
            <TableRow>
                <TableHead class="w-12">Rank</TableHead>
                <TableHead>Player</TableHead>
                <TableHead class="text-right">Score</TableHead>
                <TableHead class="w-14 text-right">Δ</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="entry in entries" :key="entry.rank">
                <TableCell
                    class="font-display font-semibold"
                    :class="rankColor(entry.rank)"
                >
                    #{{ entry.rank }}
                </TableCell>
                <TableCell>
                    <div class="flex items-center gap-2">
                        <Avatar class="size-7">
                            <AvatarImage
                                v-if="entry.avatar"
                                :src="entry.avatar"
                                :alt="entry.name"
                            />
                            <AvatarFallback class="text-xs">
                                {{ getInitials(entry.name) }}
                            </AvatarFallback>
                        </Avatar>
                        <span class="font-medium text-foreground">
                            {{ entry.name }}
                        </span>
                    </div>
                </TableCell>
                <TableCell class="text-right font-display text-foreground">
                    {{ entry.score.toLocaleString() }}
                </TableCell>
                <TableCell class="text-right">
                    <span
                        class="inline-flex items-center gap-0.5 text-xs font-medium"
                        :class="
                            entry.change > 0
                                ? 'text-success'
                                : entry.change < 0
                                  ? 'text-destructive'
                                  : 'text-muted-foreground'
                        "
                    >
                        <ArrowUp v-if="entry.change > 0" class="size-3" />
                        <ArrowDown
                            v-else-if="entry.change < 0"
                            class="size-3"
                        />
                        <Minus v-else class="size-3" />
                        {{ Math.abs(entry.change) }}
                    </span>
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>
