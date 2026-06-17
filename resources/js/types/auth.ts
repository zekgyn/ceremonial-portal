export type User = {
    id: number;
    name: string;
    phone: string;
    email: string;
    role: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    vendor: {
        id: number;
        business_name: string;
        description: string;
        category: 'venue_decoration'|'media_intertainment'|'food_drinks';
        location: string;
        verified: boolean;
    };
    [key: string]: unknown;
};

export type Auth = {
    user: User;
};

export type TwoFactorConfigContent = {
    title: string;
    description: string;
    buttonText: string;
};
