document.addEventListener('DOMContentLoaded', function() {
    const gameGrid = document.querySelector('.game-grid');
    const scoreElement = document.getElementById('score');
    const timeElement = document.getElementById('time');
    
    // 游戏数据
    const gameItems = [
        { id: 1, image: 'didongyi.jpg', name: '地动仪', info: '张衡发明的世界上第一个地震仪' },
        { id: 2, image: 'zhinanche.jpg', name: '指南车', info: '利用差动齿轮原理的导航装置' },
        { id: 3, image: 'optics.jpg', name: '小孔成像', info: '墨子发现的光学现象' }
    ];
    
    let score = 0;
    let flippedCards = [];
    let matchedPairs = 0;
    
    function createGameBoard() {
        // 创建配对卡片
        const pairs = [...gameItems, ...gameItems];
        pairs.sort(() => Math.random() - 0.5);
        
        pairs.forEach((item, index) => {
            const card = document.createElement('div');
            card.className = 'game-card-match';
            card.dataset.id = item.id;
            card.dataset.index = index;
            
            const front = document.createElement('div');
            front.className = 'card-front';
            front.style.backgroundImage = `url('/web/source/images/card-back.jpg')`;
            
            const back = document.createElement('div');
            back.className = 'card-back';
            back.style.backgroundImage = `url('/web/source/images/achievements/${item.image}')`;
            
            card.appendChild(front);
            card.appendChild(back);
            
            card.addEventListener('click', handleCardClick);
            gameGrid.appendChild(card);
        });
    }
    
    function handleCardClick(e) {
        const card = e.currentTarget;
        
        if (flippedCards.length < 2 && !flippedCards.includes(card) && !card.classList.contains('matched')) {
            card.classList.add('flipped');
            flippedCards.push(card);
            
            if (flippedCards.length === 2) {
                checkMatch();
            }
        }
    }
    
    function checkMatch() {
        const [card1, card2] = flippedCards;
        const match = card1.dataset.id === card2.dataset.id;
        
        if (match) {
            card1.classList.add('matched');
            card2.classList.add('matched');
            score += 10;
            scoreElement.textContent = score;
            matchedPairs++;
            
            // 显示物理知识
            const itemInfo = gameItems.find(item => item.id === parseInt(card1.dataset.id));
            setTimeout(() => {
                alert(`配对成功！\n${itemInfo.name}：${itemInfo.info}`);
            }, 500);
            
            if (matchedPairs === gameItems.length) {
                endGame(true);
            }
        } else {
            setTimeout(() => {
                card1.classList.remove('flipped');
                card2.classList.remove('flipped');
            }, 1000);
        }
        
        flippedCards = [];
    }
    
    function endGame(won) {
        if (won) {
            alert(`恭喜你赢得了游戏！\n得分：${score}`);
        } else {
            alert(`游戏结束！\n得分：${score}`);
        }
    }
    
    // 初始化游戏
    createGameBoard();
}); 