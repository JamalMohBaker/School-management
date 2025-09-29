@extends('layouts.dashboard')
@section('title', __('dashboard.app_name'))

@section('content')

<!-- Timer Section -->
<div class="timer-container text-white bg-success-gradient mt-2 text-dark p-3 text-center mb-4">
    <h4>Exam: {{ $exam->title }}</h4>
    <p>⏰ Time Remaining</p>
    <div id="exam-timer" class="display-4 fw-bold"></div>
    <p>Start: {{ $startTime }}</p>
    <p>duration: {{ $exam->duration_minutes }}</p>
    {{-- <p>Test {{ $exam_session }}</p> --}}
</div>
<div>
    <form id="examForm">
        @csrf
        <input type="hidden" name="exam_id" id="exam_id" value="{{ $exam->id }}">

        @foreach ($allQuestions as $question)
        <div class="bg-white p-1 mt-3">
            <div>
                <p>Q{{$loop->iteration}} / {{$question->the_question}}</p>
            </div>
            <div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="answers[{{$question->id}}]" value="option_A"
                        required>
                    <label class="form-check-label">
                        {{$question->option_A}}
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="answers[{{$question->id}}]" value="option_B">
                    <label class="form-check-label">
                        {{$question->option_B}}
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="answers[{{$question->id}}]" value="option_C">
                    <label class="form-check-label">
                        {{$question->option_C}}
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="answers[{{$question->id}}]" value="option_D">
                    <label class="form-check-label">
                        {{$question->option_D}}
                    </label>
                </div>
                <div class="form-check mb-2 d-none">
                    <input class="form-check-input" type="radio" name="answers[{{$question->id}}]" value="null" checked>
                    <label class="form-check-label">
                        {{$question->option_D}}
                    </label>
                </div>
            </div>
        </div>
        @endforeach

        <div class="text-center my-3">
            <a class="p-2 btn btn-success-gradient rounded-pill btn-wave mt-1 px-4" onclick="submitExam()"> Submit
                Answers ✅
            </a>
        </div>
    </form>
</div>


@endsection
@section('scripts')
<script>
    let examId = document.getElementById('exam_id').value;
    // وقت انتهاء الامتحان من PHP
    const examEndTime = new Date("{{ $endTime  }}").getTime();
    
    // تحديث العداد كل ثانية
    const timer = setInterval(function() {
        const now = new Date().getTime();
        const distance = examEndTime - now;
        
        // إذا انتهى الوقت
        if (distance < 0) {
            clearInterval(timer);
            document.getElementById("exam-timer").innerHTML = "TIME EXPIRED";
            document.getElementById("exam-timer").classList.add("text-danger");
            // هنا يمكنك إضافة submit تلقائي للإجابات
            // alert("Time is up! Submitting your answers...");
            submitExam();
            window.location.href = `/students/ExamInfo/${examId}`;
        }
        
        // حساب الساعات والدقائق والثواني
        const hours = Math.floor(distance / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // عرض الوقت المتبقي
        document.getElementById("exam-timer").innerHTML = 
            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        // تغيير اللون عندما يقل الوقت عن 5 دقائق
        if (hours === 0 && minutes < 5) {
            document.getElementById("exam-timer").classList.add("text-danger");
            document.getElementById("exam-timer").classList.remove("text-success");
        }
        
    }, 1000); // تحديث كل ثانية



            function performStore() {
                axios.post('/grades', {
                name: document.getElementById('name_grade').value
                })
                .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById("add_grade").reset();
                })
                .catch(function (error) {
                console.log(error);
                toastr.error(error.response.data.message);
                });
            }
</script>
<script>
    function submitExam() {
    // جمع جميع البيانات من النموذج
    const formData = new FormData(document.getElementById('examForm'));
    
    // تحويل البيانات إلى كائن JSON
    const answers = {};
    formData.forEach((value, key) => {
    if (key.startsWith('answers')) {
    const questionId = key.match(/\[(.*?)\]/)[1];
    answers[questionId] = value;
    }
    });
    
    const data = {
    exam_id: formData.get('exam_id'),
    answers: answers,
    _token: formData.get('_token')
    };
    let examId = document.getElementById('exam_id').value;
    // إرسال البيانات
    axios.post('/examAnswer', data)
    .then(function (response) {
    console.log(response);
    toastr.success(response.data.message);
    // إعادة توجيه أو إجراء آخر بعد التخزين
    window.location.href = `/students/ExamInfo/${examId}`;
    
    })
    .catch(function (error) {
    console.log(error);
    toastr.error(error.response.data.message);
    });
    }
</script>
@endsection