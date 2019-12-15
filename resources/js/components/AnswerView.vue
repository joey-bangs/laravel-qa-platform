<script>
    export default {
        name: "AnswerView",
        props: {
            answer: {
                type: Object,
                required: true
            }
        },
        data: function () {
            return {
                isEditing: false,
                slimAnswer: {
                    id: this.answer.id,
                    questionId: this.answer.question_id,
                    bodyHtml: this.answer.body_html,
                    body: this.answer.body
                },
                bodyFormValue: this.answer.body
            };
        },
        methods: {
            openEditAnswerForm: function () {
                this.isEditing = true;
            },
            updateAnswer: async function () {
                try {
                    const response = await axios.patch(this.endpoint, {body: this.bodyFormValue});

                    const answer = response.data.answer;

                    this.slimAnswer = {
                        id: answer.id,
                        questionId: answer.question_id,
                        bodyHtml: answer.body_html,
                        body: answer.body
                    };
                    this.bodyFormValue = answer.body;

                    this.isEditing = false;

                    this.$toast.success(
                        response.data.message,
                        "Success",
                        {timeout: 3000}
                    )
                } catch (error) {
                    this.bodyFormValue = this.slimAnswer.body;

                    this.$toast.error(
                        error.response.data.message,
                        "Error",
                        {timeout: 3000}
                    );
                }
            },
            cancelUpdateAnswer: function () {
                this.bodyFormValue = this.slimAnswer.body;
                this.isEditing = false;
            },
            deleteAnswer: async function () {
                this.$toast.question("Are you sure about that?", "Confirm", {
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: "once",
                    id: "question",
                    zindex: 999,
                    position: "center",
                    buttons: [
                        ['<button><b>YES</b></button>', async (instance, toast) => {
                            try {
                                const response = await axios.delete(this.endpoint);

                                $(this.$el).fadeOut(500,
                                    () => this.$toast.success(
                                        response.data.message,
                                        "Success",
                                        {timeout: 3000}
                                    )
                                );
                            } catch (error) {
                                this.$toast.error(
                                    error.response.data.message,
                                    "Error",
                                    {timeout: 3000}
                                );
                            }

                            instance.hide({transitionOut: "fadeOut"}, toast, "button");

                        }, true],
                        ['<button>NO</button>', function (instance, toast) {

                            instance.hide({transitionOut: "fadeOut"}, toast, "button");

                        }],
                    ],
                    onClosing: function (instance, toast, closedBy) {
                        console.info("Closing | closedBy: " + closedBy);
                    },
                    onClosed: function (instance, toast, closedBy) {
                        console.info("Closed | closedBy: " + closedBy);
                    }
                });
            }
        },
        computed: {
            endpoint: function () {
                return `/questions/${this.slimAnswer.questionId}/answers/${this.slimAnswer.id}`;
            },
            isFieldValid: function () {
                return this.bodyFormValue.trim().length > 0;
            },
            fieldClassStyleObject: function () {
                return {'is-invalid': !this.isFieldValid};
            }
        }
    }
</script>

