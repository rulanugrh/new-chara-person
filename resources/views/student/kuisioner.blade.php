@extends('layouts.student')

@section('content')
<div class="min-h-screen bg-gray-50 py-8" x-data="questionnaireWizard()" x-init="init()">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Kuisioner Minat Bakat</h1>
                <p class="text-gray-600">Jawab pertanyaan berikut dengan jujur untuk mengetahui minat dan bakat Anda</p>
            </div>

            <!-- Progress Indicator -->
            <div class="mt-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-700">Progress</span>
                    <span class="text-sm font-medium text-gray-700" x-text="currentPage + ' dari ' + totalPages + ' halaman'"></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                         :style="`width: ${(currentPage / totalPages) * 100}%`"></div>
                </div>
                <div class="flex justify-between mt-2">
                    <span class="text-xs text-gray-500" x-text="`Pertanyaan ${((currentPage - 1) * perPage) + 1} - ${Math.min(currentPage * perPage, totalQuestions)} dari ${totalQuestions}`"></span>
                    <span class="text-xs text-gray-500" x-text="`${Math.round((currentPage / totalPages) * 100)}% selesai`"></span>
                </div>
            </div>
        </div>

        <!-- Scale Legend -->
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
            <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-blue-800">
                <span class="font-semibold">Skala Penilaian:</span>
                <span>1 = Sangat Tidak Setuju</span>
                <span>2 = Tidak Setuju</span>
                <span>3 = Netral</span>
                <span>4 = Setuju</span>
                <span>5 = Sangat Setuju</span>
            </div>
        </div>

        @if(empty($currentQuestions))
            <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
                <div class="rounded-3xl border border-yellow-300 bg-yellow-50 p-6 text-yellow-800 inline-block">
                    <p class="font-semibold">Belum ada pertanyaan kuisioner yang aktif.</p>
                    <p class="mt-2 text-sm text-yellow-700">Silakan hubungi admin untuk membuat pertanyaan kuisioner terlebih dahulu.</p>
                </div>
            </div>
        @else
            <form method="POST" action="{{ route('student.kuisioner.store') }}" class="space-y-6" x-ref="questionnaireForm" @submit.prevent="handleFormSubmit()">
                @csrf
                <input type="hidden" name="current_page" x-model="currentPage">
                    <template x-for="(question, index) in questions" :key="question.id">
                        <div class="question-item border-b border-gray-100 pb-6 last:border-b-0 last:pb-0"
                             x-cloak
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-x-4"
                             x-transition:enter-end="opacity-100 transform translate-x-0">

                            <div class="flex-1">
                                <p class="text-gray-800 mb-3 font-medium">
                                    <span class="font-semibold text-gray-600 mr-2" x-text="getQuestionNumber(index) + '.'"></span>
                                    <span x-text="question.question"></span>
                                </p>

                                    <template x-if="question.help_text">
                                        <p class="text-sm text-slate-500 mb-3" x-text="question.help_text"></p>
                                    </template>

                                    <div class="flex items-center space-x-4">
                                        <template x-for="i in 5">
                                            <label class="flex items-center space-x-2 cursor-pointer group">
                                                <input
                                                    type="radio"
                                                    :name="`jawaban[${question.id}]`"
                                                    :value="i"
                                                    :checked="answers[question.id] == i"
                                                    class="w-4 h-4 text-blue-600 focus:ring-blue-500 group-hover:ring-2 group-hover:ring-blue-300 transition-all"
                                                    required
                                                    @change="updateAnswer(question.id, i)"
                                                >
                                                <span class="text-sm font-medium text-gray-700 group-hover:text-blue-600 transition-colors" x-text="i"></span>
                                            </label>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Navigation inside the same card -->
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <div class="flex items-center justify-between">
                            <button
                                type="button"
                                @click="goToPrevious()"
                                :disabled="currentPage === 1"
                                class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors flex items-center space-x-2"
                                x-show="currentPage > 1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                <span>Previous</span>
                            </button>

                            <div class="flex-1 text-center">
                                <span class="text-sm text-gray-500" x-text="`Halaman ${currentPage} dari ${totalPages}`"></span>
                            </div>

                            <button
                                type="button"
                                @click="goToNext()"
                                :disabled="!canProceed()"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors flex items-center space-x-2"
                                x-show="currentPage < totalPages">
                                <span>Next</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>

                            <button
                                type="submit"
                                :disabled="!canProceed()"
                                class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors flex items-center space-x-2"
                                x-show="currentPage === totalPages">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Finish</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>

<script>
function questionnaireWizard() {
    return {
        questions: @json($currentQuestions),
        currentPage: Number(@json($currentPage)),
        totalPages: Number(@json($totalPages)),
        totalQuestions: Number(@json($totalQuestions)),
        perPage: Number(@json($perPage)),
        answers: @json($existingJawaban->toArray()),

        init() {
            console.log('Raw questions from Blade:', @json($currentQuestions));
            console.log('Questions type:', typeof this.questions, 'Is array:', Array.isArray(this.questions));
            
            // Load answers from localStorage
            const savedAnswers = localStorage.getItem('kuisioner_answers');
            if (savedAnswers) {
                const parsed = JSON.parse(savedAnswers);
                this.answers = { ...this.answers, ...parsed };
            }

            // Force numeric pagination values so x-show works correctly
            this.currentPage = Number(this.currentPage);
            this.totalPages = Number(this.totalPages);
            this.totalQuestions = Number(this.totalQuestions);
            this.perPage = Number(this.perPage);

            // Ensure all answers are integers
            for (let key in this.answers) {
                this.answers[key] = parseInt(this.answers[key]);
            }

            console.log('Initialized with questions:', this.questions);
            console.log('Answers after init:', this.answers);
            console.log('currentPage:', this.currentPage, 'totalPages:', this.totalPages);
        },

        canProceed() {
            console.log('Checking canProceed for questions:', this.questions ? this.questions.length : 'undefined');
            console.log('Current answers:', this.answers);
            
            if (!Array.isArray(this.questions) || this.questions.length === 0) {
                console.log('Questions not ready or empty');
                return false;
            }
            
            for (let question of this.questions) {
                const answer = this.answers[question.id];
                const isValid = answer && (parseInt(answer) >= 1 && parseInt(answer) <= 5);
                console.log('Question', question.id, '- answer:', answer, 'type:', typeof answer, 'valid:', isValid);
                if (!isValid) {
                    console.log('Missing or invalid answer for question', question.id);
                    return false;
                }
            }
            console.log('All questions answered');
            return true;
        },

        updateAnswer(questionId, score) {
            // Ensure score is integer
            this.answers[questionId] = parseInt(score);
            // Save to localStorage
            localStorage.setItem('kuisioner_answers', JSON.stringify(this.answers));
            console.log('Updated answer for question', questionId, 'to', this.answers[questionId], 'type:', typeof this.answers[questionId]);
        },

        goToPrevious() {
            if (this.currentPage > 1) {
                window.location.href = '{{ route("student.kuisioner.index") }}?page=' + (this.currentPage - 1);
            }
        },

        handleFormSubmit() {
            if (this.currentPage === this.totalPages) {
                // Create hidden inputs ONLY for questions on current page before submitting
                console.log('Submitting form from last page');
                console.log('Current page:', this.currentPage, 'Total pages:', this.totalPages);
                
                // Add hidden inputs only for questions currently displayed
                if (Array.isArray(this.questions)) {
                    for (let question of this.questions) {
                        if (this.answers[question.id]) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = `jawaban[${question.id}]`;
                            input.value = this.answers[question.id];
                            this.$refs.questionnaireForm.appendChild(input);
                        }
                    }
                }
                
                localStorage.removeItem('kuisioner_answers');
                this.$refs.questionnaireForm.submit();
            } else {
                // Trigger goToNext untuk halaman sebelumnya
                console.log('Form submit from non-last page, triggering goToNext');
                this.goToNext();
            }
        },

        goToNext() {
            console.log('goToNext called');
            console.log('canProceed:', this.canProceed());
            console.log('currentPage:', this.currentPage, 'totalPages:', this.totalPages);

            if (!this.canProceed()) {
                console.log('Cannot proceed - not all questions answered');
                alert('Silakan jawab semua pertanyaan di halaman ini terlebih dahulu.');
                return;
            }

            if (this.currentPage >= this.totalPages) {
                console.log('Already on last page');
                return;
            }

            console.log('Proceeding to next page...');

            // Submit current step answers via AJAX
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('current_page', this.currentPage);

            // Add current step answers
            let answerCount = 0;
            if (Array.isArray(this.questions)) {
                for (let question of this.questions) {
                    if (this.answers[question.id]) {
                        formData.append(`jawaban[${question.id}]`, this.answers[question.id]);
                        answerCount++;
                    }
                }
            }

            console.log('Submitting', answerCount, 'answers');

            fetch('{{ route("student.kuisioner.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(response => {
                console.log('Response received, status:', response.status);
                return response.json().then(data => {
                    console.log('Response data:', data);

                    if (response.ok && data.success) {
                        const nextPage = data.next_page || (this.currentPage + 1);
                        console.log('Success! Redirecting to page', nextPage);
                        // Clear localStorage after successful save
                        localStorage.removeItem('kuisioner_answers');
                        window.location.href = '{{ route("student.kuisioner.index") }}?page=' + nextPage;
                    } else {
                        console.error('Server error:', data);
                        alert(data.message || 'Terjadi kesalahan saat menyimpan jawaban.');
                    }
                }).catch(jsonError => {
                    console.error('JSON parse error:', jsonError);
                    alert('Terjadi kesalahan dalam memproses respons server.');
                });
            }).catch(fetchError => {
                console.error('Fetch error:', fetchError);
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
            });
        },
    }
}
</script>
@endsection