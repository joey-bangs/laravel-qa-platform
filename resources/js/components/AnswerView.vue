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

                    alert('Successfully edited!');
                } catch (error) {
                    this.bodyFormValue = this.slimAnswer.body;

                    alert(error.response.data.message);
                }
            },
            cancelUpdateAnswer: function () {
                this.bodyFormValue = this.slimAnswer.body;
                this.isEditing = false;
            },
            deleteAnswer: async function () {
                if (!confirm('Are you sure?')) {
                    return;
                }

                try {
                    const response = await axios.delete(this.endpoint);

                    $(this.$el).fadeOut(500, () => alert(response.data.message));
                } catch (error) {
                    alert(error.response.data.message);
                }
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

