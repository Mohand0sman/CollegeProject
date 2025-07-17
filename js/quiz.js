const container = document.querySelector('.container');
let questions = [];
let currentIndex = 0;

let request = new XMLHttpRequest();
request.open('GET' , 'data.json');
request.responseType = 'json';
request.send();
request.onload = function(){
    if(request.status >= 200 & request.status <= 299){
        questions = request.response;
        showQuestion(currentIndex);
    }
}

const scores = {
    "علوم حاسوب": 0,
    "هندسة البرمجيات": 0,
    "أمن المعلومات": 0,
    "نظم المعلومات": 0,
    "شبكات الحاسوب": 0,
    "تقنية المعلومات": 0,
    "ذكاء أصطناعي": 0,
    "تحليل البيانات": 0
}

const message = {
    "علوم حاسوب": "عقليتك تميل إلي التفكير العميق هذا هو مكانك",
    "هندسة البرمجيات": "تحب بناء الواجهات والتطوير لن تجد أنسب من هذا لك",
    "أمن المعلومات": "يبدو أنك تحب التحقيق ومتابعة الأدلة هنا ستفهم كيف تدار الجريمة",
    "نظم المعلومات": "المؤسسات في أنتظارك لإدارة أنظمتها بكفاءة",
    "شبكات الحاسوب": "الشبكات ليست مجرد توصيلات هناك أستراجيات تتبع لتحسين الأتصالات",
    "تقنية المعلومات": "الدعم التقني ليس بتلك السهولة فقط الشخصيات المسؤولة تستطيع الألتزام",
    "ذكاء أصطناعي": "هل فكرت أن تكون معلم لكن ليس للبشر, الأن أنت مسؤول من تعليم الألة",
    "تحليل البيانات": "عالم الأرقام معقد ولا يستطيع المدراء أخذ القرارات بناء عليه , عليك ان تحلل الأرقام إلي شئ مفهوم"
}


function showQuestion(Index) {
    const currentQuestion = questions[Index];
    const options = currentQuestion.options.map((option) => {
        return ` <p class="answer" onclick="userAnswer('${option.specialty}')"> ${option.text} </p> `
    })

    container.innerHTML = `  <h2 class="question"> ${currentQuestion.question} </h2>
            <hr>
            <div class="answers">
                ${options.join('')}
            </div> `

}



function userAnswer(specialty) {
    console.log(specialty);
    handleScore(specialty);
    currentIndex++;

    if (currentIndex < questions.length) {
        showQuestion(currentIndex);
    } else {
        showResult();
    }
}

function handleScore(specialty) {
    const cleanKey = specialty.trim();
    scores[cleanKey]++;
}

function showResult() {
    const sorted = Object.entries(scores).sort((a, b) => b[1] - a[1]);


    container.innerHTML = `
            <div class="result">
                <h2>التخصص المناسب لك هو :</h2>
                <div class="sp"> ${sorted[0][0]} </div>
                <div class="advance">
                    ${message[sorted[0][0]]}
                </div>
                <a href='index.html#explore'> أقرأ أكثر عن <span>${sorted[0][0]}</span></a>
            </div>
    `
}



