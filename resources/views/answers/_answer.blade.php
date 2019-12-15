<answer-view :answer="{{ $answer }}" inline-template>
    <div class="media post">
        <div class="d-flex flex-column vote-controls">
            @include('shared._vote_controls', ['model' => $answer, 'text' => 'answer', 'route_name' => 'vote.answer'])
        </div>

        <form class="media-body" v-if="isEditing" @submit.prevent="updateAnswer">
            <div class="form-group">
                <label for="body">Edit your answer</label>
                <textarea v-model="bodyFormValue" id="body" cols="30" rows="7"
                          class="form-control"
                          :class="fieldClassStyleObject"
                >
                </textarea>
                <div v-if="!isFieldValid" class="invalid-feedback">
                    <strong>Body is required!</strong>
                </div>

            </div>
            <div class="form-group">
                <button :disabled="!isFieldValid" type="submit" class="btn btn-lg btn-primary">
                    Update answer
                </button>
                <button @click="cancelUpdateAnswer" type="button"
                        class="btn btn-lg btn-outline-primary">
                    Cancel
                </button>
            </div>
        </form>
        <div class="media-body" v-else>
            <div v-html="slimAnswer.bodyHtml"></div>
            <div class="row">
                <div class="col-md-4">
                    @can('update', $answer)
                        <a @click.prevent="openEditAnswerForm"
                           class="btn btn-sm btn-outline-info">
                            Edit
                        </a>
                    @endcan

                    @can('delete', $answer)
                        <form action="{{ route('questions.answers.destroy', [$answer->question->id, $answer->id]) }}"
                              class="delete-form" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="alert('Delete?')">
                                Delete
                            </button>
                        </form>
                    @endcan
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <user-info text="Answered" :model="{{  $answer }}"></user-info>
                </div>
            </div>

        </div>
    </div>
</answer-view>
