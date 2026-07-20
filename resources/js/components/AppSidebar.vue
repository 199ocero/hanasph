<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    BookOpen,
    FolderGit2,
    LayoutGrid,
    ListOrdered,
    Target,
    Trophy,
} from '@lucide/vue';
import AppLogo from '@/components/AppLogo.vue';
import LevelBadge from '@/components/LevelBadge.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Separator } from '@/components/ui/separator';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Achievements',
        href: dashboard(),
        icon: Trophy,
        isActive: false,
    },
    {
        title: 'Leaderboard',
        href: dashboard(),
        icon: ListOrdered,
        isActive: false,
    },
    {
        title: 'Quests',
        href: dashboard(),
        icon: Target,
        isActive: false,
    },
];

const playerLevel = 12;
const playerXp = 340;
const playerXpToNext = 500;

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: FolderGit2,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <div
                class="flex items-center gap-2.5 px-2 py-1.5 group-data-[collapsible=icon]:hidden"
            >
                <LevelBadge
                    :level="playerLevel"
                    :progress="(playerXp / playerXpToNext) * 100"
                    size="sm"
                />
                <div class="min-w-0 flex-1">
                    <p
                        class="truncate text-xs font-medium text-sidebar-foreground"
                    >
                        Level {{ playerLevel }}
                    </p>
                    <p class="truncate text-[11px] text-muted-foreground">
                        {{ playerXp }} / {{ playerXpToNext }} XP
                    </p>
                </div>
            </div>
            <Separator class="group-data-[collapsible=icon]:hidden" />
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
