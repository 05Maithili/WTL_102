let task = [];

const addTask = () => {
    const input = document.querySelector('#taskinput input');
    const text = input.value.trim();
    if (text) {
        task.push({ text: text, completed: false });
        input.value = "";
        updateTasksList();
    }
};

const updateTasksList = () => {
    const taskList = document.getElementById("task-list");
    taskList.innerHTML = "";

    task.forEach((t, idx) => {
        const listitem = document.createElement('li');
        listitem.className = 'task-item' + (t.completed ? ' completed' : '');

        // If editing, show input and save/cancel
        if (t.editing) {
            listitem.innerHTML = `
                <input class="edit-input" type="text" value="${t.text}" maxlength="100" style="flex:1; margin-right:10px; padding:8px; border-radius:6px; border:1.5px solid var(--teal); font-size:1rem;">
                <button class="save-btn" title="Save">💾</button>
                <button class="cancel-btn" title="Cancel">✖</button>
            `;
            // Save
            listitem.querySelector('.save-btn').addEventListener('click', () => {
                const val = listitem.querySelector('.edit-input').value.trim();
                if (val) {
                    t.text = val;
                    delete t.editing;
                    updateTasksList();
                }
            });
            // Cancel
            listitem.querySelector('.cancel-btn').addEventListener('click', () => {
                delete t.editing;
                updateTasksList();
            });
            // Enter key saves, Esc cancels
            listitem.querySelector('.edit-input').addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    listitem.querySelector('.save-btn').click();
                } else if (e.key === 'Escape') {
                    listitem.querySelector('.cancel-btn').click();
                }
            });
            // Autofocus
            setTimeout(() => listitem.querySelector('.edit-input').focus(), 0);
        } else {
            listitem.innerHTML = `
                <span class="task-text" style="text-decoration:${t.completed ? 'line-through' : 'none'};color:${t.completed ? '#888' : '#fff'}">${t.text}</span>
                <button class="edit-btn" title="Edit">✏️</button>
                <button class="complete-btn" title="Mark as ${t.completed ? 'incomplete' : 'complete'}">${t.completed ? '✔' : '○'}</button>
                <button class="delete-btn" title="Delete">🗑</button>
            `;
            // Edit button
            listitem.querySelector('.edit-btn').addEventListener('click', () => {
                t.editing = true;
                updateTasksList();
            });
            // Complete button
            listitem.querySelector('.complete-btn').addEventListener('click', () => {
                task[idx].completed = !task[idx].completed;
                updateTasksList();
            });
            // Delete button
            listitem.querySelector('.delete-btn').addEventListener('click', () => {
                task.splice(idx, 1);
                updateTasksList();
            });
        }
        taskList.appendChild(listitem);
    });
    updateStats();
};

function updateStats() {
    const done = task.filter(t => t.completed).length;
    const total = task.length;
    document.getElementById('numbers').textContent = `${done} / ${total}`;
    const progress = document.getElementById('progress');
    const percent = total === 0 ? 0 : Math.round((done / total) * 100);
    progress.style.width = total === 0 ? '0%' : `${percent}%`;
    // ARIA for accessibility
    const progressBar = document.getElementById('progressBar');
    if (progressBar) {
        progressBar.setAttribute('aria-valuenow', percent);
        progressBar.setAttribute('aria-valuetext', `${percent}% complete`);
    }
    // Confetti animation when all tasks are completed
    if (total > 0 && done === total) {
        showConfetti();
    }
}

// Simple confetti animation
function showConfetti() {
    if (document.getElementById('confetti-canvas')) return; // Prevent multiple
    const canvas = document.createElement('canvas');
    canvas.id = 'confetti-canvas';
    canvas.style.position = 'fixed';
    canvas.style.left = 0;
    canvas.style.top = 0;
    canvas.style.width = '100vw';
    canvas.style.height = '100vh';
    canvas.style.pointerEvents = 'none';
    canvas.style.zIndex = 9999;
    document.body.appendChild(canvas);
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    const ctx = canvas.getContext('2d');
    const colors = ['#24feee', '#828dff', '#fff', '#ff4d4d', '#ffe066'];
    const confetti = Array.from({length: 120}, () => ({
        x: Math.random() * canvas.width,
        y: Math.random() * -canvas.height,
        r: 6 + Math.random() * 8,
        d: 8 + Math.random() * 8,
        color: colors[Math.floor(Math.random() * colors.length)],
        tilt: Math.random() * 10 - 5,
        tiltAngle: 0,
        tiltAngleIncremental: (Math.random() * 0.07) + 0.05
    }));
    let angle = 0;
    let frame = 0;
    function draw() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        angle += 0.01;
        for (let i = 0; i < confetti.length; i++) {
            let c = confetti[i];
            c.tiltAngle += c.tiltAngleIncremental;
            c.y += (Math.cos(angle + c.d) + 3 + c.r / 2) * 0.8;
            c.x += Math.sin(angle);
            c.tilt = Math.sin(c.tiltAngle) * 15;
            ctx.beginPath();
            ctx.lineWidth = c.r;
            ctx.strokeStyle = c.color;
            ctx.moveTo(c.x + c.tilt + c.r / 3, c.y);
            ctx.lineTo(c.x + c.tilt, c.y + c.d);
            ctx.stroke();
        }
        frame++;
        if (frame < 90) {
            requestAnimationFrame(draw);
        } else {
            canvas.remove();
        }
    }
    draw();
}

document.getElementById('newtask').addEventListener("click", function (e) {
    e.preventDefault();
    addTask();
});

// Optional: Enter key submits
document.querySelector('#taskinput input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        addTask();
    }
});

// Initial render
updateTasksList();