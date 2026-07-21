export type AdminTaskSummary = {
    slug: string;
    order: number;
    title: string;
    category: string;
    aiGradingEnabled: boolean;
    beatsCount: number;
};

export type AdminCourseSummary = {
    skillKey: string;
    title: string;
    subtitle: string | null;
    isPublished: boolean;
    lessonsCount: number;
};

export type AdminLesson = {
    slug: string;
    title: string;
    body: string;
};

export type AdminOption = {
    id: number;
    order: number;
    body: string;
    isCorrect: boolean;
    diagnostic: string | null;
    lesson: AdminLesson | null;
};

export type AdminBeat = {
    id: number;
    order: number;
    clientMessage: string;
    scaffoldHint: string | null;
    tagalogTip: string | null;
    options: AdminOption[];
};

export type AdminTask = {
    slug: string;
    title: string;
    clientPersona: string;
    scenarioIntro: string;
    category: string;
    aiGradingEnabled: boolean;
    xpReward: number;
};

export type AdminRubricCriterion = {
    criterion: string;
    weight: number;
    what_good_looks_like: string;
};

export type AdminSkillLesson = {
    id: number;
    order: number;
    title: string;
    brief: string;
    difficulty: string;
    xpReward: number;
    acceptedFormats: string[];
    tip: string | null;
    aiLeverage: { approach: string; prompt: string } | null;
    isPublished: boolean;
    rubric: AdminRubricCriterion[];
    referenceNotes: string | null;
};

export type AdminSkillCourse = {
    skillKey: string;
    title: string;
    subtitle: string | null;
    source: string;
    isPublished: boolean;
};
