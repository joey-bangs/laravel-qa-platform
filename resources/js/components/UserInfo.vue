<template>
    <div>
        <span class="text-muted">{{ datePosted }}</span>

        <div class="media mt-4" v-if="canViewUserInfo">
            <a :href="user.url" class="pr-2">
                <img :alt="altText" :src="user.avatar" />
            </a>
            <div class="media-body mt-1">
                <a :href="user.url">
                    {{ user.name }}
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import Auth from "../services/auth";

export default {
    name: "UserInfo",
    props: {
        text: {
            type: String,
            required: true
        },
        model: {
            type: Object,
            required: true
        }
    },
    data: function() {
        return {
            user: this.model.user
        };
    },
    computed: {
        datePosted: function() {
            return `${this.text} ${this.model.created_date}`;
        },
        altText: function() {
            return `${this.user.name}'s avatar`;
        },
        canViewUserInfo: function() {
            return (
                Auth.currentUser().is_counsellor ||
                this.user.id === Auth.currentUser().id
            );
        }
    }
};
</script>
