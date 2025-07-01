// 成就详情数据
const achievementDetails = {
    'optics': {
        title: '古代光学成就',
        content: `
            <div class="achievement-detail">
                <h3>墨子的光学理论</h3>
                <p>墨子在光学方面有重要发现，他通过观察小孔成像现象，首次发现了光的直线传播规律，提出了著名的"光至影亡"理论。</p>
                
                <h3>主要贡献</h3>
                <ul>
                    <li>发现光的直线传播规律</li>
                    <li>研究小孔成像现象</li>
                    <li>提出"光至影亡"理论</li>
                </ul>
                
                <div class="quote-box">
                    <p>"光至影亡"理论说明了光的直线传播特性，这是世界上最早的光学理论之一。</p>
                </div>
            </div>
        `
    },
    'didongyi': {
        title: '地动仪 - 世界最早的地震仪',
        content: `
            <div class="achievement-detail">
                <h3>发明背景</h3>
                <p>公元132年，张衡发明了世界上第一台地震仪。这个精密的仪器不仅能探测到地震的发生，还能判断地震波的来向。</p>
                
                <h3>工作原理</h3>
                <ul>
                    <li>仪器外形为圆桶状，周围装有八条龙头</li>
                    <li>龙头对应八个方向，口中各含铜球</li>
                    <li>当地震发生时，对应方向的龙头会张口放出铜球</li>
                    <li>铜球落入蟾蜍口中发出声响，提示地震方向</li>
                </ul>
                
                <h3>历史意义</h3>
                <p>地动仪的发明比西方早1600多年，是中国古代科技史上的重要里程碑。</p>
            </div>
        `
    },
    'zhinanche': {
        title: '指南车 - 古代导航奇器',
        content: `
            <div class="achievement-detail">
                <h3>发明特点</h3>
                <p>指南车是利用差动齿轮原理制造的机械导航装置，不论车行转向如何，车上木制人像的手始终指向南方。</p>
                
                <h3>核心技术</h3>
                <ul>
                    <li>采用差动齿轮系统</li>
                    <li>机械自动补偿原理</li>
                    <li>精密的齿轮传动装置</li>
                </ul>
                
                <h3>历史影响</h3>
                <p>作为早期的导航工具，指南车在古代军事、交通等领域发挥了重要作用。</p>
            </div>
        `
    },
    'huentianyi': {
        title: '浑天仪 - 天文观测利器',
        content: `
            <div class="achievement-detail">
                <h3>仪器特点</h3>
                <p>浑天仪是古代重要的天文观测仪器，采用精密的机械传动装置，用于观测天体运动规律。</p>
                
                <h3>功能作用</h3>
                <ul>
                    <li>测定天体位置</li>
                    <li>观测天象变化</li>
                    <li>推算时间节气</li>
                </ul>
                
                <h3>科学价值</h3>
                <p>体现了古人对天文观测和机械制造的深刻理解，对历法制定有重要帮助。</p>
            </div>
        `
    },
    'mirror': {
        title: '古代镜子制造技术',
        content: `
            <div class="achievement-detail">
                <h3>制造工艺</h3>
                <p>郑复光在《镜镜詅痴》中详细记录了各种反射镜和折射镜的制造方法，展现了古人对光学的深入认识。</p>
                
                <h3>技术特点</h3>
                <ul>
                    <li>精湛的金属冶炼技术</li>
                    <li>对光的反射规律的运用</li>
                </ul>
                
                <h3>历史意义</h3>
                <p>古代镜子制造技术的发展推动了光学理论的进步，也促进了冶金工艺的提升。</p>
            </div>
        `
    },
    'bianzhong': {
        title: '编钟 - 古代声学成就',
        content: `
            <div class="achievement-detail">
                <h3>制作特点</h3>
                <p>编钟是古代重要的礼乐器，其制作涉及精确的声学计算和精湛的青铜冶炼技术。</p>
                
                <h3>声学原理</h3>
                <ul>
                    <li>双音现象的应用</li>
                    <li>音高的精确控制</li>
                    <li>谐振原理的运用</li>
                </ul>
                
                <h3>科技价值</h3>
                <p>编钟的制作体现了古人对声学规律的深刻认识，是声学研究的重要实物证据。</p>
            </div>
        `
    },
    'acoustics': {
        title: '古代声学理论',
        content: `
            <div class="achievement-detail">
                <h3>理论发展</h3>
                <p>沈括在《梦溪笔谈》中记录了声音反射等声学现象，展现了宋代科学家对声学的研究成果。</p>
                
                <h3>主要发现</h3>
                <ul>
                    <li>声音的反射现象</li>
                    <li>回声的形成原理</li>
                    <li>声音的传播特性</li>
                </ul>
                
                <h3>历史贡献</h3>
                <p>这些声学理论的记录为后世研究声学现象提供了重要的历史资料。比如北京天坛，回音壁采用了非常光滑的砖材建造，使得声音波能够在几乎无损的情况下反射传递。此外，墙体呈圆弧形设计，有助于集中和导向声波，减少了能量损失，从而实现了远距离的清晰传声效果。</p>
            </div>
        `
    }
};

// 显示弹窗
function showAchievementDetail(achievementId) {
    const modal = document.getElementById('achievementModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    
    const detail = achievementDetails[achievementId];
    if (detail) {
        modalTitle.textContent = detail.title;
        modalContent.innerHTML = detail.content;
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden'; // 防止背景滚动
    }
}

// 关闭弹窗
function closeModal() {
    const modal = document.getElementById('achievementModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto'; // 恢复背景滚动
}

// 点击弹窗外部关闭
window.onclick = function(event) {
    const modal = document.getElementById('achievementModal');
    if (event.target === modal) {
        closeModal();
    }
}