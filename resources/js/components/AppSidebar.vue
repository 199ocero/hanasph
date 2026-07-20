<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, Route, Sparkles } from '@lucide/vue';
import { computed } from 'vue';
import {
    index as coursesIndex,
    show as courseShow,
} from '@/actions/App/Http/Controllers/SkillCourseController';
import AppLogo from '@/components/AppLogo.vue';
import LevelBadge from '@/components/LevelBadge.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Separator } from '@/components/ui/separator';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Track',
        href: dashboard(),
        icon: Route,
    },
];

const page = usePage();
const progression = computed(() => page.props.progression);
const catalog = computed(() => page.props.catalog ?? []);
const levelProgress = computed(() => {
    const p = progression.value;
    if (!p || p.xpForNextLevel === 0) {
        return 0;
    }
    return (p.xpIntoLevel / p.xpForNextLevel) * 100;
});
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

            <SidebarGroup v-if="catalog.length">
                <SidebarGroupLabel>Courses</SidebarGroupLabel>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton as-child>
                            <Link :href="coursesIndex.url()">
                                <BookOpen />
                                <span>All courses</span>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                    <SidebarMenuItem
                        v-for="course in catalog"
                        :key="course.skillKey"
                    >
                        <SidebarMenuButton as-child :tooltip="course.title">
                            <Link
                                :href="
                                    courseShow.url({ course: course.skillKey })
                                "
                            >
                                <BookOpen />
                                <span>{{ course.title }}</span>
                                <Sparkles
                                    v-if="course.recommended"
                                    class="ml-auto size-3 text-primary"
                                />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarGroup>
        </SidebarContent>

        <SidebarFooter>
            <div
                v-if="progression"
                class="flex items-center gap-2.5 px-2 py-1.5 group-data-[collapsible=icon]:hidden"
            >
                <LevelBadge
                    :level="progression.level"
                    :progress="levelProgress"
                    size="sm"
                />
                <div class="min-w-0 flex-1">
                    <p
                        class="truncate text-xs font-medium text-sidebar-foreground"
                    >
                        Level {{ progression.level }}
                    </p>
                    <p class="truncate text-[11px] text-muted-foreground">
                        {{ progression.xpIntoLevel }} /
                        {{ progression.xpForNextLevel }} XP
                    </p>
                </div>
            </div>
            <Separator class="group-data-[collapsible=icon]:hidden" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
