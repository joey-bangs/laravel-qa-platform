<template>
    <div>
        <span class="text-muted">{{ datePosted }}</span>

        <div class="media mt-4">
            <a :href="user.url" class="pr-2">
                <img :alt="altText"
                     :src="user.avatar">
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
    export default {
        name: "UserInfo",
        props: ['text', 'model'],
        data: function () {
            return {
                user: this.model.user
            }
        },
        computed: {
            datePosted() {
                return this.text + ' ' + this.model.created_date;
            },
            altText() {
                return this.user.name + "'s avatar";
            }
        }
    }
</script>

<style scoped>

</style>
