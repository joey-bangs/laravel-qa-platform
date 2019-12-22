<template>
    <div>
        <a
            v-if="canAcceptAnswer"
            title="Click to mark as accepted answer (Click again to undo)"
            class="mt-2"
            :class="status"
            @click.prevent="markAsAccepted"
        >
            <i class="fas fa-check fa-2x"></i>
        </a>

        <a
            v-else-if="!canAcceptAnswer && isBest"
            title="The question owner marked this answer as accepted answer"
            class="mt-2"
            :class="status"
        >
            <i class="fas fa-check fa-2x"></i>
        </a>
    </div>
</template>

<script>
export default {
    name: "AcceptAnswerControl",
    props: {
        answer: {
            type: Object,
            required: true
        }
    },
    data: function() {
        return {
            id: this.answer.id,
            status: this.answer.status,
            isBest: this.answer.is_best
        };
    },
    methods: {
        markAsAccepted: async function() {
            try {
                const response = await axios.post(this.endpoint);

                const { id, status, is_best } = response.data.answer;

                this.id = id;
                this.status = status;
                this.isBest = is_best;
            } catch (error) {
                this.$toast.error(error.response.data.message, "Error", {
                    timeout: 3000
                });
            }
        }
    },
    computed: {
        endpoint: function() {
            return `/answers/${this.id}/accept`;
        },
        canAcceptAnswer: function() {
            return this.$gate.allow("accept", "answer", this.answer);
        }
    }
};
</script>
