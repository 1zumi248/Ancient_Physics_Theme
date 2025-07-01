document.addEventListener('DOMContentLoaded', function() {
    const wordBank = document.querySelector('.word-bank');
    const printingArea = document.querySelector('.printing-area');
    
    // 扩充游戏数据
    const gameData = [
        {
            question: "墨子关于光的传播提出了什么著名观点？",
            answer: "光至影亡",
            characters: "光至影亡日月明暗",
            hint: "这个理论解释了光线传播的直线性",
            info: "墨子通过观察小孔成像现象，首次发现了光的直线传播规律。"
        },
        {
            question: "张衡发明的地震仪叫什么名字？",
            answer: "地动仪",
            characters: "地动仪器测量",
            hint: "这是世界上第一台地震仪",
            info: "地动仪能够测定地震发生的方向，是世界上最早的地震仪。"
        },
        {
            question: "沈括在《梦溪笔谈》中记录了什么重要的物理现象？",
            answer: "磁偏角",
            characters: "磁偏角南北指",
            hint: "与指南针的指向有关",
            info: "沈括首次发现了地磁偏角现象，对后世航海事业产生重要影响。"
        },
        {
            question: "祖冲之在计算圆周率时达到了多少位精确度？",
            answer: "七位数",
            characters: "七位数字算法",
            hint: "一个数字加上'位数'",
            info: "祖冲之将圆周率计算到小数点后七位，是当时世界最精确的结果。"
        }
    ];
    
    let currentGame = 0;
    let totalScore = 0;
    
    function initGame() {
        // 清空区域
        wordBank.innerHTML = '';
        printingArea.innerHTML = '';
        
        // 创建题目显示区
        updateQuestionDisplay();
        
        // 创建字符块
        const chars = gameData[currentGame].characters.split('');
        chars.sort(() => Math.random() - 0.5);
        
        chars.forEach(char => {
            const charDiv = createCharacterDiv(char);
            wordBank.appendChild(charDiv);
        });
        
        // 创建答案槽
        const answerLength = gameData[currentGame].answer.length;
        for (let i = 0; i < answerLength; i++) {
            const slot = document.createElement('div');
            slot.className = 'character-slot';
            printingArea.appendChild(slot);
        }
        
        // 更新进度显示
        updateProgress();
    }
    
    function updateQuestionDisplay() {
        const questionDiv = document.createElement('div');
        questionDiv.className = 'question-display';
        questionDiv.innerHTML = `
            <div class="question-header">
                <span class="question-number">第 ${currentGame + 1} 题 / 共 ${gameData.length} 题</span>
                <span class="total-score">总分: ${totalScore}</span>
            </div>
            <h3 class="question-text">${gameData[currentGame].question}</h3>
            <div class="hint-text">提示：${gameData[currentGame].hint}</div>
        `;
        
        // 移除旧的问题显示
        const oldQuestion = document.querySelector('.question-display');
        if (oldQuestion) {
            oldQuestion.remove();
        }
        
        printingArea.parentElement.insertBefore(questionDiv, printingArea);
    }
    
    function updateProgress() {
        const progressBar = document.createElement('div');
        progressBar.className = 'progress-bar';
        progressBar.innerHTML = `
            <div class="progress" style="width: ${(currentGame / gameData.length) * 100}%"></div>
        `;
        document.querySelector('.game-section').appendChild(progressBar);
    }
    
    function createCharacterDiv(char) {
        const div = document.createElement('div');
        div.className = 'character';
        div.textContent = char;
        div.draggable = true;
        
        div.addEventListener('dragstart', handleDragStart);
        div.addEventListener('dragend', handleDragEnd);
        
        return div;
    }
    
    function handleDragStart(e) {
        e.dataTransfer.setData('text/plain', e.target.textContent);
        e.target.classList.add('dragging');
        
        // 添加拖动效果
        document.querySelectorAll('.character-slot:not(:has(.character))').forEach(slot => {
            slot.classList.add('hover');
        });
    }
    
    function handleDragEnd(e) {
        e.target.classList.remove('dragging');
        document.querySelectorAll('.character-slot').forEach(slot => {
            slot.classList.remove('hover');
        });
    }
    
    printingArea.addEventListener('dragover', e => {
        e.preventDefault();
    });
    
    printingArea.addEventListener('drop', e => {
        e.preventDefault();
        const char = e.dataTransfer.getData('text/plain');
        const target = e.target.closest('.character-slot');
        
        if (target && !target.hasChildNodes()) {
            const charDiv = createCharacterDiv(char);
            charDiv.draggable = false;
            target.appendChild(charDiv);
            
            // 添加放置音效
            playDropSound();
        }
    });
    
    function playDropSound() {
        const audio = new Audio('source/sounds/wood-click.mp3');
        audio.volume = 0.3;
        audio.play();
    }
    
    document.getElementById('check-answer').addEventListener('click', () => {
        const answer = Array.from(printingArea.children)
            .map(slot => slot.firstChild?.textContent || '')
            .join('');
            
        if (answer === gameData[currentGame].answer) {
            totalScore += 100;
            showSuccess();
            setTimeout(() => {
                if (currentGame < gameData.length - 1) {
                    currentGame++;
                    initGame();
                } else {
                    showGameComplete();
                }
            }, 1500);
        } else {
            showError();
        }
    });
    
    function showSuccess() {
        const overlay = document.createElement('div');
        overlay.className = 'success-overlay';
        overlay.innerHTML = `
            <div class="success-message">
                <h3>恭喜你答对了！</h3>
                <p class="success-info">${gameData[currentGame].info}</p>
                <div class="score-addition">+100分</div>
            </div>
        `;
        document.body.appendChild(overlay);
        
        setTimeout(() => {
            overlay.remove();
        }, 1500);
    }
    
    function showError() {
        printingArea.classList.add('shake');
        setTimeout(() => {
            printingArea.classList.remove('shake');
        }, 500);
    }
    
    function showGameComplete() {
        const overlay = document.createElement('div');
        overlay.className = 'complete-overlay';
        overlay.innerHTML = `
            <div class="complete-message">
                <h2>恭喜完成所有题目！</h2>
                <button onclick="location.reload()">再玩一次</button>
            </div>
        `;
        document.body.appendChild(overlay);
    }
    
    document.getElementById('reset-game').addEventListener('click', initGame);
    
    // 初始化游戏
    initGame();
}); 