<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mobius Smart Bin – {{ $binId }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background-color: #0f172a;
            color: #f9fafb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Kiosk Mode Optimizations */
            cursor: none;
            /* Hide cursor for touch screens */
            touch-action: manipulation;
            /* Improve touch handling */
            user-select: none;
            /* Prevent text selection */
        }

        .container {
            max-width: 480px;
            width: 100%;
            padding: 1.5rem;
            box-sizing: border-box;
        }

        .card {
            background-color: #020617;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.8);
            border: 1px solid #1f2937;
        }

        h1 {
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
            text-align: center;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat {
            flex: 1;
            padding: 1rem;
            border-radius: 0.75rem;
            background-color: #111827;
            text-align: center;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #9ca3af;
            margin-bottom: 0.25rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
        }

        .button {
            display: block;
            width: 100%;
            padding: 1rem 1.25rem;
            border-radius: 999px;
            border: none;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            background: linear-gradient(90deg, #22c55e, #16a34a);
            color: #022c22;
            margin-bottom: 1.5rem;
            transition: transform 0.1s ease, box-shadow 0.1s ease, opacity 0.1s ease;
            box-shadow: 0 20px 30px -15px rgba(34, 197, 94, 0.7);
        }

        .button:active {
            transform: translateY(1px) scale(0.99);
            box-shadow: 0 12px 20px -12px rgba(34, 197, 94, 0.7);
        }

        .button[disabled] {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .message {
            text-align: center;
            margin-bottom: 1rem;
            min-height: 1.5rem;
        }

        .message.error {
            color: #fca5a5;
        }

        .qr-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .qr-label {
            font-size: 0.95rem;
            color: #e5e7eb;
        }

        .claim-url {
            font-size: 0.85rem;
            word-break: break-all;
            color: #93c5fd;
            text-align: center;
        }

        .section-heading {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .events-section {
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 0.75rem;
            background-color: #0b1220;
            border: 1px solid #1f2937;
        }

        .events-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .event-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            background-color: #111827;
            border: 1px solid #1f2937;
        }

        .event-brand {
            font-weight: 600;
        }

        .event-material {
            font-size: 0.85rem;
            color: #9ca3af;
        }

        .event-meta {
            text-align: right;
        }

        .event-points {
            display: inline-block;
            font-weight: 600;
            color: #4ade80;
        }

        .event-time {
            display: block;
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .event-empty {
            text-align: center;
            color: #9ca3af;
            font-size: 0.9rem;
            padding: 0.5rem 0;
        }

        .summary-section {
            display: none;
            margin-bottom: 1.25rem;
            padding: 1rem;
            border-radius: 0.75rem;
            background-color: #0b1220;
            border: 1px solid #1f2937;
        }

        .summary-grid {
            display: flex;
            gap: 1rem;
        }

        .claim-success {
            display: none;
            flex-direction: column;
            gap: 0.75rem;
            align-items: center;
            text-align: center;
        }

        .button.secondary {
            background: transparent;
            border: 2px solid #22c55e;
            color: #f9fafb;
            box-shadow: none;
        }

        .button.secondary:active {
            transform: scale(0.99);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Mobius Smart Bin – {{ $binId }}</h1>

            <div id="stats-section" class="stats">
                <div class="stat">
                    <div class="stat-label">Cups this session</div>
                    <div id="cups-count" class="stat-value">—</div>
                </div>
                <div class="stat">
                    <div class="stat-label">Points this session</div>
                    <div id="points-count" class="stat-value">—</div>
                </div>
            </div>

            <div class="events-section">
                <div class="section-heading">Session Activity</div>
                <div id="events-list" class="events-list">
                    <p class="event-empty">No cups recorded yet.</p>
                </div>
            </div>

            <button id="finish-button" class="button" type="button">
                Finish Session
            </button>

            <div id="message" class="message"></div>

            <div id="summary-section" class="summary-section">
                <div class="section-heading">Session Summary</div>
                <div class="summary-grid">
                    <div class="stat">
                        <div class="stat-label">Total Cups</div>
                        <div id="summary-cups" class="stat-value">0</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Total Points</div>
                        <div id="summary-points" class="stat-value">0</div>
                    </div>
                </div>
            </div>

            <div id="qr-section" class="qr-wrapper" style="display: none;">
                <div id="qr-display" style="display: flex; flex-direction: column; gap: 0.75rem; align-items: center;">
                    <div class="qr-label">
                        Scan this QR code to claim your reward.
                    </div>
                    <canvas id="qr-canvas" width="256" height="256" aria-label="Claim QR"></canvas>
                    <a id="claim-url" class="claim-url" href="#" target="_blank" rel="noopener"></a>
                </div>

                <div id="claim-success" class="claim-success">
                    <div class="section-heading">Points claimed!</div>
                    <p id="claimed-message" class="qr-label"></p>
                    <button id="new-session-button" class="button secondary" type="button">
                        Start New Disposal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const binId = @json($binId);
            const finishButton = document.getElementById('finish-button');
            const messageEl = document.getElementById('message');
            const qrSection = document.getElementById('qr-section');
            const qrDisplay = document.getElementById('qr-display');
            const claimSuccessEl = document.getElementById('claim-success');
            const claimedMessageEl = document.getElementById('claimed-message');
            const qrCanvas = document.getElementById('qr-canvas');
            const claimUrlEl = document.getElementById('claim-url');
            const statsSection = document.getElementById('stats-section');
            const cupsCountEl = document.getElementById('cups-count');
            const pointsCountEl = document.getElementById('points-count');
            const eventsListEl = document.getElementById('events-list');
            const summarySection = document.getElementById('summary-section');
            const summaryCupsEl = document.getElementById('summary-cups');
            const summaryPointsEl = document.getElementById('summary-points');
            const newSessionButton = document.getElementById('new-session-button');

            let qr;
            let pollIntervalId;
            let claimPollIntervalId;
            let sessionFinished = false;
            let currentSessionId = null;

            function setMessage(text, isError = false) {
                messageEl.textContent = text || '';
                messageEl.classList.toggle('error', Boolean(isError));
            }

            function escapeHtml(value) {
                if (value === null || value === undefined) {
                    return '';
                }

                return String(value)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#039;');
            }

            function renderEvents(events) {
                if (!Array.isArray(events) || events.length === 0) {
                    eventsListEl.innerHTML = '<p class="event-empty">No cups recorded yet.</p>';
                    return;
                }

                const formatter = new Intl.DateTimeFormat([], {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                });

                eventsListEl.innerHTML = events
                    .map((event) => {
                        const brand = escapeHtml(event?.brand ?? 'Unknown');
                        const material = escapeHtml(event?.material ?? '—');
                        const points = Number.isFinite(event?.points_awarded) ? event.points_awarded : 0;
                        const time = event?.created_at
                            ? formatter.format(new Date(event.created_at))
                            : '--:--:--';

                        return `
                                <div class="event-card">
                                    <div>
                                        <div class="event-brand">${brand}</div>
                                        <div class="event-material">${material}</div>
                                    </div>
                                    <div class="event-meta">
                                        <span class="event-points">+${points}</span>
                                        <span class="event-time">${time}</span>
                                    </div>
                                </div>
                            `;
                    })
                    .join('');
            }

            function updateSummary(cups, points) {
                summaryCupsEl.textContent = Number.isFinite(cups) ? cups : 0;
                summaryPointsEl.textContent = Number.isFinite(points) ? points : 0;
            }

            function showSummary(cups, points) {
                updateSummary(cups, points);
                summarySection.style.display = 'block';
            }

            function hideSummary() {
                summarySection.style.display = 'none';
                updateSummary(0, 0);
            }

            async function fetchStatus() {
                if (sessionFinished) {
                    return;
                }

                try {
                    const response = await fetch(`/api/bin-sessions/${encodeURIComponent(binId)}/status`, {
                        headers: {
                            'Accept': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        return;
                    }

                    const data = await response.json();
                    cupsCountEl.textContent = data.cups_count ?? 0;
                    pointsCountEl.textContent = data.total_points ?? 0;
                    renderEvents(data.events ?? []);

                    if (data.has_active_session) {
                        currentSessionId = data.bin_session_id;
                    } else if (!sessionFinished) {
                        currentSessionId = null;
                    }
                } catch (error) {
                    console.error('Unable to fetch bin status', error);
                }
            }

            function startPolling() {
                fetchStatus();
                pollIntervalId = setInterval(fetchStatus, 2000);
            }

            function stopPolling() {
                if (pollIntervalId) {
                    clearInterval(pollIntervalId);
                    pollIntervalId = undefined;
                }
            }

            function startClaimStatusPolling() {
                if (!currentSessionId) {
                    return;
                }

                stopClaimStatusPolling();
                checkClaimStatus();
                claimPollIntervalId = setInterval(checkClaimStatus, 2000);
            }

            function stopClaimStatusPolling() {
                if (claimPollIntervalId) {
                    clearInterval(claimPollIntervalId);
                    claimPollIntervalId = undefined;
                }
            }

            async function checkClaimStatus() {
                if (!currentSessionId) {
                    return;
                }

                try {
                    const response = await fetch(`/api/bin-sessions/${currentSessionId}`, {
                        headers: {
                            'Accept': 'application/json',
                        },
                    });

                    if (!response.ok) {
                        return;
                    }

                    const data = await response.json();

                    if (Array.isArray(data.events)) {
                        renderEvents(data.events);
                    }

                    if (typeof data.cups_count === 'number') {
                        updateSummary(data.cups_count, data.total_points ?? 0);
                    }

                    if (data.status === 'claimed') {
                        stopClaimStatusPolling();
                        handleClaimSuccess(data);
                    }
                } catch (error) {
                    console.error('Unable to poll claim status', error);
                }
            }

            function renderQr(claimUrl) {
                if (!qr) {
                    qr = new QRious({
                        element: qrCanvas,
                        size: 256,
                        level: 'H',
                        background: '#ffffff',
                        foreground: '#000000',
                    });
                }

                qr.value = claimUrl;
                claimUrlEl.textContent = claimUrl;
                claimUrlEl.href = claimUrl;
            }

            function handleClaimSuccess(data) {
                const points = data.total_points ?? 0;
                const claimedBy = data?.claimed_by?.name
                    ? `${data.claimed_by.name} claimed ${points} points.`
                    : `Claimed ${points} points.`;

                setMessage('Session claimed successfully!');
                claimedMessageEl.textContent = claimedBy;

                qrDisplay.style.display = 'none';
                claimSuccessEl.style.display = 'flex';
                qrSection.style.display = 'flex';
            }

            function resetToIdleState() {
                sessionFinished = false;
                currentSessionId = null;
                setMessage('');
                stopClaimStatusPolling();
                stopPolling();

                statsSection.style.display = 'flex';
                finishButton.style.display = 'block';
                finishButton.disabled = false;
                qrSection.style.display = 'none';
                qrDisplay.style.display = 'flex';
                claimSuccessEl.style.display = 'none';
                claimUrlEl.textContent = '';
                claimUrlEl.removeAttribute('href');
                hideSummary();
                renderEvents([]);
                cupsCountEl.textContent = '—';
                pointsCountEl.textContent = '—';

                startPolling();
            }

            async function finishSession() {
                setMessage('');
                qrSection.style.display = 'none';
                qrDisplay.style.display = 'flex';
                claimSuccessEl.style.display = 'none';
                claimUrlEl.textContent = '';
                claimUrlEl.removeAttribute('href');

                finishButton.disabled = true;
                setMessage('Finishing session...');

                try {
                    const response = await fetch('/api/bin-sessions/finish', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            bin_id: binId,
                        }),
                    });

                    let data = null;

                    try {
                        data = await response.clone().json();
                    } catch (parseError) {
                        console.warn('Unable to parse finish response', parseError);
                    }

                    if (!response.ok) {
                        const errorMessage = data?.message
                            ?? `Unable to finish session (status ${response.status}).`;
                        setMessage(errorMessage, true);
                        return;
                    }

                    if (!data?.success) {
                        const finishError = data?.message ?? 'Unable to finish session.';
                        setMessage(finishError, true);
                        return;
                    }

                    if (!data?.claim_url) {
                        setMessage('Finished session but response was missing claim data.', true);
                        return;
                    }

                    sessionFinished = true;
                    stopPolling();

                    currentSessionId = data.bin_session_id ?? null;
                    const points = data.total_points ?? 0;
                    const cups = data.cups_count ?? (Array.isArray(data.events) ? data.events.length : 0);

                    setMessage(`Session ready to claim. ${points} points earned this round.`);

                    renderEvents(data.events ?? []);
                    showSummary(cups, points);

                    renderQr(data.claim_url);

                    qrSection.style.display = 'flex';
                    qrDisplay.style.display = 'flex';
                    statsSection.style.display = 'none';
                    finishButton.style.display = 'none';

                    startClaimStatusPolling();
                } catch (error) {
                    setMessage('An error occurred. Please try again.', true);
                } finally {
                    if (!sessionFinished) {
                        finishButton.disabled = false;
                    }
                }
            }

            finishButton.addEventListener('click', finishSession);
            newSessionButton.addEventListener('click', resetToIdleState);
            startPolling();
        })();
    </script>
</body>

</html>