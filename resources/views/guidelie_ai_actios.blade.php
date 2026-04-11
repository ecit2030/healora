<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healora | Guideline AI Actions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --brand: #047857;
            --brand-soft: #ecfdf5;
        }
        body {
            background:
                radial-gradient(circle at 15% 15%, rgba(16, 185, 129, 0.08), transparent 30%),
                radial-gradient(circle at 85% 0%, rgba(59, 130, 246, 0.08), transparent 25%),
                #f1f5f9;
        }
        .glass {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(10px);
        }
        .message-enter {
            animation: message-enter .25s ease-out;
        }
        @keyframes message-enter {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .typing-dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: #64748b;
            animation: pulse-dot 1s infinite ease-in-out;
        }
        .typing-dot:nth-child(2) { animation-delay: .15s; }
        .typing-dot:nth-child(3) { animation-delay: .3s; }
        @keyframes pulse-dot {
            0%, 80%, 100% { opacity: .25; transform: translateY(0); }
            40% { opacity: 1; transform: translateY(-2px); }
        }
    </style>
</head>
<body class="min-h-screen text-slate-900">
    <main class="mx-auto flex h-screen max-w-7xl gap-3 px-2 py-3 sm:px-4 sm:py-4">
        <aside class="glass hidden w-72 shrink-0 rounded-2xl border border-white/60 p-4 shadow-sm lg:block">
            <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Guideline AI</p>
            <h2 class="mt-1 text-lg font-bold">Operator Tools</h2>
            <div class="mt-4 space-y-2 text-sm">
                <button data-template="Explain Healora bed management workflow step by step." class="template-btn w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-left hover:bg-slate-50">Bed workflow explanation</button>
                <button data-template="Give high-priority recommendations to reduce boarding now." class="template-btn w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-left hover:bg-slate-50">Emergency recommendations</button>
                <button data-template="Send high notification to ops@example.com for Pharmacy." class="template-btn w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-left hover:bg-slate-50">Send test notification command</button>
                <button id="clearChatBtn" class="w-full rounded-xl border border-rose-200 bg-rose-50 px-3 py-2 text-left text-rose-700 hover:bg-rose-100">Clear conversation</button>
            </div>
            <div class="mt-5 rounded-xl border border-slate-200 bg-white p-3 text-xs text-slate-600">
                <p class="font-semibold text-slate-700">Tips</p>
                <p class="mt-1">Use plain commands like: <span class="font-mono">send test notification to you@email.com for Radiology</span></p>
            </div>
        </aside>

        <section class="glass flex min-h-0 flex-1 flex-col overflow-hidden rounded-2xl border border-white/60 shadow-sm">
            <header class="border-b border-slate-200/80 px-4 py-3 sm:px-5">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Guideline AI</p>
                        <h1 class="text-base font-bold sm:text-lg">Deep Search Chat</h1>
                    </div>
                    <span id="status" class="rounded-full bg-white px-3 py-1 text-xs text-slate-600 ring-1 ring-slate-200">Ready</span>
                </div>
            </header>

            <div id="chatMessages" class="flex-1 space-y-4 overflow-y-auto p-4 sm:p-6">
                <div id="emptyState" class="mx-auto mt-12 max-w-md rounded-2xl border border-slate-200 bg-white px-4 py-5 text-center text-sm text-slate-500 shadow-sm">
                    Conversation ready.
                </div>
            </div>

            <div class="border-t border-slate-200/80 bg-white/80 p-3 sm:p-4">
                <div class="mb-3 flex flex-wrap gap-2 lg:hidden">
                    <button data-template="Explain Healora bed management workflow step by step." class="template-btn rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-700 hover:bg-slate-50">Bed workflow</button>
                    <button data-template="Send high notification to ops@example.com for Pharmacy." class="template-btn rounded-full border border-slate-200 bg-white px-3 py-1.5 text-xs text-slate-700 hover:bg-slate-50">Send notification</button>
                </div>
                <div class="rounded-2xl border border-slate-300 bg-white p-2 shadow-sm">
                    <textarea id="question" rows="2" class="w-full resize-none border-0 px-2 py-2 text-sm outline-none focus:ring-0" placeholder="Message Guideline AI..."></textarea>
                    <div class="mt-2 flex items-center justify-between">
                        <p class="text-xs text-slate-500">Enter to send, Shift+Enter new line</p>
                        <div class="flex items-center gap-2">
                            <button id="voiceBtn" type="button" class="rounded-xl border border-slate-300 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-50 disabled:cursor-not-allowed disabled:opacity-60">Voice</button>
                            <button id="askBtn" type="button" class="rounded-xl bg-emerald-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-800 disabled:cursor-not-allowed disabled:opacity-60">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        const askUrl = @json(route('guidelie.ai.actions.ask'));
        const askBtn = document.getElementById('askBtn');
        const question = document.getElementById('question');
        const chatMessages = document.getElementById('chatMessages');
        const statusEl = document.getElementById('status');
        const voiceBtn = document.getElementById('voiceBtn');
        const clearChatBtn = document.getElementById('clearChatBtn');
        const templateBtns = Array.from(document.querySelectorAll('.template-btn'));
        let typingRow = null;
        let recognition = null;
        let isListening = false;
        let speechSupported = false;

        function escapeHtml(value) {
            return value
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#39;');
        }

        function addMessage(role, text, metaHtml = '') {
            const isUser = role === 'user';
            const emptyState = document.getElementById('emptyState');
            if (emptyState) {
                emptyState.remove();
            }
            const row = document.createElement('div');
            row.className = `message-enter flex ${isUser ? 'justify-end' : 'justify-start'}`;

            const bubble = document.createElement('div');
            bubble.className = isUser
                ? 'max-w-[90%] rounded-2xl rounded-tr-md bg-emerald-700 px-4 py-3 text-sm leading-6 text-white sm:max-w-[80%]'
                : 'max-w-[90%] rounded-2xl rounded-tl-md border border-slate-200 bg-white px-4 py-3 text-sm leading-6 text-slate-700 shadow-sm sm:max-w-[80%]';
            bubble.setAttribute('data-message-bubble', '1');
            bubble.innerHTML = `<div class="whitespace-pre-wrap">${escapeHtml(text)}</div>${metaHtml}`;

            row.appendChild(bubble);
            chatMessages.appendChild(row);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function setTyping(active) {
            if (active) {
                if (typingRow) return;
                const row = document.createElement('div');
                row.className = 'message-enter flex justify-start';
                row.id = 'typingRow';
                row.innerHTML = `
                    <div class="rounded-2xl rounded-tl-md border border-slate-200 bg-white px-4 py-3 shadow-sm">
                        <div class="flex items-center gap-1.5">
                            <span class="typing-dot"></span><span class="typing-dot"></span><span class="typing-dot"></span>
                        </div>
                    </div>
                `;
                chatMessages.appendChild(row);
                typingRow = row;
                chatMessages.scrollTop = chatMessages.scrollHeight;
                return;
            }
            if (typingRow) {
                typingRow.remove();
                typingRow = null;
            }
        }

        async function askDeepSearch() {
            const q = question.value.trim();
            if (!q) {
                statusEl.textContent = 'Please enter a question.';
                return;
            }

            askBtn.disabled = true;
            statusEl.textContent = 'Searching...';
            addMessage('user', q);
            question.value = '';
            setTyping(true);

            try {
                const response = await fetch(askUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': @json(csrf_token()),
                    },
                    body: JSON.stringify({ question: q }),
                });

                if (!response.ok) {
                    statusEl.textContent = 'Request failed.';
                    setTyping(false);
                    addMessage('assistant', 'Request failed. Please try again.');
                    return;
                }

                const data = await response.json();
                const hits = Array.isArray(data.hits) ? data.hits : [];
                const citations = Array.isArray(data.citations) ? data.citations : [];
                const meta = `
                    <div class="mt-3 border-t border-slate-200 pt-3 text-xs text-slate-500">
                        <p class="font-semibold text-slate-600">Top sources</p>
                        <ul class="mt-1 space-y-1">
                            ${hits.length
                                ? hits.map((h) => `<li>${escapeHtml(h.source)} - ${escapeHtml(h.title)} (score ${h.score})</li>`).join('')
                                : '<li>No strong match.</li>'}
                        </ul>
                        <p class="mt-2 font-semibold text-slate-600">Citations</p>
                        <ul class="mt-1 space-y-1">
                            ${citations.length
                                ? citations.map((c) => `<li>${escapeHtml(c.source)} | ${escapeHtml(c.title)} | ${c.year} | ${escapeHtml(c.domain)}</li>`).join('')
                                : '<li>No citations returned.</li>'}
                        </ul>
                        <button data-copy-btn="1" class="mt-3 rounded-lg border border-slate-200 bg-slate-50 px-2 py-1 text-[11px] font-medium text-slate-600 hover:bg-slate-100">Copy response</button>
                    </div>
                `;
                setTyping(false);
                addMessage('assistant', data.answer || 'No answer generated.', meta);

                statusEl.textContent = 'Done';
            } catch (error) {
                statusEl.textContent = 'Error during request.';
                setTyping(false);
                addMessage('assistant', 'Error during request. Please try again.');
            } finally {
                askBtn.disabled = false;
                question.focus();
            }
        }

        askBtn.addEventListener('click', askDeepSearch);
        question.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' && !event.shiftKey) {
                event.preventDefault();
                askDeepSearch();
            }
        });

        function initVoiceInput() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) {
                voiceBtn.disabled = true;
                voiceBtn.textContent = 'Voice N/A';
                statusEl.textContent = 'Voice not supported in this browser';
                return;
            }
            speechSupported = true;

            recognition = new SpeechRecognition();
            recognition.lang = navigator.language || 'en-US';
            recognition.interimResults = true;
            recognition.continuous = false;

            recognition.onstart = () => {
                isListening = true;
                voiceBtn.textContent = 'Listening...';
                voiceBtn.classList.add('border-emerald-300', 'bg-emerald-50', 'text-emerald-700');
                statusEl.textContent = 'Listening...';
            };

            recognition.onresult = (event) => {
                let transcript = '';
                for (let i = event.resultIndex; i < event.results.length; i++) {
                    transcript += event.results[i][0].transcript;
                }
                question.value = transcript.trim();
            };

            recognition.onend = () => {
                isListening = false;
                voiceBtn.textContent = 'Voice';
                voiceBtn.classList.remove('border-emerald-300', 'bg-emerald-50', 'text-emerald-700');
                statusEl.textContent = 'Ready';
            };

            recognition.onerror = () => {
                isListening = false;
                voiceBtn.textContent = 'Voice';
                voiceBtn.classList.remove('border-emerald-300', 'bg-emerald-50', 'text-emerald-700');
                statusEl.textContent = 'Voice error';
            };

            voiceBtn.addEventListener('click', async () => {
                if (!speechSupported) return;
                if (!recognition) return;
                if (isListening) {
                    recognition.stop();
                    return;
                }
                try {
                    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                        stream.getTracks().forEach((track) => track.stop());
                    }
                    recognition.start();
                } catch (error) {
                    statusEl.textContent = 'Microphone permission blocked';
                }
            });

            recognition.onerror = (event) => {
                isListening = false;
                voiceBtn.textContent = 'Voice';
                voiceBtn.classList.remove('border-emerald-300', 'bg-emerald-50', 'text-emerald-700');

                const errorMap = {
                    not_allowed: 'Microphone permission denied',
                    service_not_allowed: 'Speech service blocked by browser',
                    no_speech: 'No speech detected',
                    audio_capture: 'No microphone found',
                    network: 'Speech recognition network error',
                    aborted: 'Voice listening stopped',
                };

                statusEl.textContent = errorMap[event.error] || 'Voice error';
            };
        }

        templateBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const template = btn.getAttribute('data-template') || '';
                question.value = template;
                question.focus();
            });
        });

        if (clearChatBtn) {
            clearChatBtn.addEventListener('click', () => {
                chatMessages.innerHTML = `
                    <div id="emptyState" class="mx-auto mt-12 max-w-md rounded-2xl border border-slate-200 bg-white px-4 py-5 text-center text-sm text-slate-500 shadow-sm">
                        Conversation ready.
                    </div>
                `;
                statusEl.textContent = 'Ready';
            });
        }

        chatMessages.addEventListener('click', async (event) => {
            const target = event.target;
            if (!(target instanceof HTMLElement)) return;
            if (target.getAttribute('data-copy-btn') !== '1') return;
            const bubble = target.closest('[data-message-bubble]');
            if (!bubble) return;
            const text = bubble.querySelector('div.whitespace-pre-wrap');
            if (!text) return;
            await navigator.clipboard.writeText(text.textContent || '');
            target.textContent = 'Copied';
            setTimeout(() => {
                target.textContent = 'Copy response';
            }, 900);
        });

        initVoiceInput();
    </script>
</body>
</html>
