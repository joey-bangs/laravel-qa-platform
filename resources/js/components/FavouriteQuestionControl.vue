<template>
    <a :class="favouredStyleClassesObject"
       @click.prevent="toggleFavour"
       class="favourite mt-2"
       title="Click to mark as favourite question (Click again to undo)">
        <i class="fas fa-star fa-2x"></i>
        <span class="favourites-count">{{ favouritesCount }}</span>
    </a>
</template>

<script>
    export default {
        name: "FavouriteQuestionControl",
        props: {
            question: {
                type: Object,
                required: true
            }
        },
        data: function () {
            return {
                isLoggedIn: this.question.user.is_logged_in,
                isFavoured: this.question.is_favoured,
                favouritesCount: this.question.favourites_count
            };
        },
        methods: {
            toggleFavour: async function () {
                if (!this.isLoggedIn) {
                    this.$toast.warning(
                        "You must login first",
                        "Warning",
                        {timeout: 3000, position: "bottomLeft"}
                    );
                    return;
                }

                try {
                    const response = await axios.patch(this.endpoint);

                    const {question} = response.data;

                    this.isFavoured = question.is_favoured;
                    this.favouritesCount = question.favourites_count;

                } catch (error) {
                    this.$toast.error(
                        error.response.data.message,
                        "Error",
                        {timeout: 3000}
                    );
                }

            }
        },
        computed: {
            endpoint: function () {
                return `/questions/${this.question.id}/toggle-favourite`;
            },
            favouredStyleClassesObject: function () {
                return {
                    "off": !this.isLoggedIn,
                    "favoured": this.isLoggedIn && this.isFavoured
                };
            }
        }
    }
</script>

