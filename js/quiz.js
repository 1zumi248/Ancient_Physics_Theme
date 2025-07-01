// 全局变量
window.questions = {
    easy: [
        {
            question: "墨子提出的著名光学理论是什么？",
            options: ["光的波动说", "光至影亡", "光的微粒说", "光的干涉"],
            correct: 1
        },
        {
            question: "张衡发明的地动仪主要用于测量什么？",
            options: ["地震方向", "地球自转", "地磁场强度", "地壳厚度"],
            correct: 0
        },
        {
            question: "沈括在《梦溪笔谈》中记录了哪种重要的物理现象？",
            options: ["光的折射", "声音传播", "磁针指向", "重力加速度"],
            correct: 2
        },
        {
            question: "祖冲之在力学方面提出了什么重要理论？",
            options: ["杠杆原理", "浮力原理", "重力理论", "摩擦力定律"],
            correct: 1
        },
        {
            question: "一行和尚完成了什么重要的物理测量工作？",
            options: ["地球子午线", "声速", "光速", "重力加速度"],
            correct: 0
        },
        {
            question: "郭守敬创制了多少件天文观测仪器？",
            options: ["十件", "十五件", "二十件", "二十五件"],
            correct: 2
        }
    ],
    medium: [
        {
            question: "墨子的小孔成像实验证明了光的什么特性？",
            options: ["反射", "折射", "直线传播", "衍射"],
            correct: 2
        },
        {
            question: "张衡的地动仪采用了什么机械原理？",
            options: ["杠杆原理", "惯性原理", "浮力原理", "摆动原理"],
            correct: 1
        },
        {
            question: "祖冲之将圆周率精确到了小数点后第几位？",
            options: ["第五位", "第六位", "第七位", "第八位"],
            correct: 2
        },
        {
            question: "赵友钦在光学方面研究了什么现象？",
            options: ["光的干涉", "凹凸面镜成像", "光的偏振", "光的衍射"],
            correct: 1
        },
        {
            question: "《天工开物》中记载了哪些物理学领域的知识？",
            options: ["仅力学", "力学和光学", "力学和声学", "力学、声学和磁学"],
            correct: 3
        },
        {
            question: "郑复光的《镜镜詅痴》主要研究什么？",
            options: ["光的反射", "镜子制造", "光的折射", "以上都是"],
            correct: 3
        }
    ],
    hard: [
        {
            question: "墨子在光学方面的贡献包括以下哪些？",
            options: ["只有小孔成像", "小孔成像和光的直线传播", "小孔成像、光的直线传播和反射", "小孔成像、光的直线传播、反射和折射"],
            correct: 2
        },
        {
            question: "张衡地动仪的关键部件是什么？",
            options: ["铜钟", "摆球", "水银", "铜龙"],
            correct: 1
        },
        {
            question: "沈括在声学方面有什么重要发现？",
            options: ["声音的反射", "声音的共振", "声音的传播速度", "声音的频率"],
            correct: 0
        },
        {
            question: "郭守敬改革的历法叫什么名字？",
            options: ["授时历", "大明历", "崇天历", "乾元历"],
            correct: 0
        },
        {
            question: "王锡阐在光学方面主要研究了什么现象？",
            options: ["反射", "折射", "两者都有", "都没有"],
            correct: 2
        },
        {
            question: "郑复光提出的'郑氏光学理论'解释了哪些现象？",
            options: ["只有反射", "反射和折射", "反射、折射和全反射", "只有折射"],
            correct: 2
        }
    ]
};

window.currentQuestions = [];
window.currentQuestionIndex = 0;
window.score = 0;
window.timer;
window.timeLeft;

// 将函数声明为全局函数
window.selectDifficulty = function(difficulty) {
    document.getElementById('difficultySelector').style.display = 'none';
    currentQuestions = shuffleArray(questions[difficulty]).slice(0, 3);
    currentQuestionIndex = 0;
    score = 0;
    startQuiz();
};

window.startQuiz = function() {
    timeLeft = 60;
    document.getElementById('timer').style.display = 'block';
    updateTimer();
    timer = setInterval(updateTimer, 1000);
    showQuestion();
};

window.showQuestion = function() {
    const question = currentQuestions[currentQuestionIndex];
    const container = document.getElementById('questionContainer');
    
    container.innerHTML = `
        <div class="question active">
            <h3>问题 ${currentQuestionIndex + 1}/3</h3>
            <p class="question-text">${question.question}</p>
            <div class="options">
                ${question.options.map((option, index) => `
                    <div class="option" onclick="checkAnswer(${index})">${option}</div>
                `).join('')}
            </div>
        </div>
    `;
};

window.checkAnswer = function(selectedIndex) {
    const question = currentQuestions[currentQuestionIndex];
    const options = document.querySelectorAll('.option');
    
    // 禁用所有选项
    options.forEach(option => option.style.pointerEvents = 'none');
    
    // 显示正确和错误答案
    options[question.correct].classList.add('correct');
    if (selectedIndex !== question.correct) {
        options[selectedIndex].classList.add('wrong');
    } else {
        score++;
    }
    
    // 延迟后进入下一题
    setTimeout(() => {
        currentQuestionIndex++;
        if (currentQuestionIndex < currentQuestions.length) {
            showQuestion();
        } else {
            endQuiz();
        }
    }, 1500);
};

window.updateTimer = function() {
    document.getElementById('timeLeft').textContent = timeLeft;
    if (timeLeft <= 0) {
        endQuiz();
    }
    timeLeft--;
};

window.endQuiz = function() {
    clearInterval(timer);
    const container = document.getElementById('questionContainer');
    const result = document.getElementById('result');
    
    container.innerHTML = '';
    document.getElementById('timer').style.display = 'none';
    
    document.getElementById('score').textContent = score;
    result.style.display = 'block';
};

window.restartQuiz = function() {
    document.getElementById('result').style.display = 'none';
    document.getElementById('difficultySelector').style.display = 'block';
};

// 辅助函数
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
} 