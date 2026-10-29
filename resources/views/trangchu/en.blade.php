<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon the Robot Cat · Websites, fanpage care, web QA & documentation</title>
    <meta name="description" content="Mon builds websites, looks after Facebook pages, tests websites and writes plain-language documentation for small businesses. Free demo first — real work, public ledger.">
    @vite(['resources/scss/bootstrap.scss', 'resources/js/app.js'])
    <style>
        :root { --mon-blue: #1b6ac9; --mon-blue-dark: #14539e; --mon-slate: #37474f; --mon-slate-dark: #263238; }
        body { background: #eef3f6; font-family: "Segoe UI", system-ui, -apple-system, BlinkMacSystemFont, "Helvetica Neue", Arial, sans-serif; }
        .mon-hero { background: linear-gradient(135deg, var(--mon-slate), var(--mon-slate-dark) 55%, var(--mon-blue-dark)); color: #fff; }
        .mon-mascot { width: 132px; height: 132px; object-fit: cover; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 4px 14px rgba(0,0,0,.35); background: #fff; }
        .mon-card { border: 0; border-radius: 1rem; box-shadow: 0 2px 10px rgba(38,50,56,.10); height: 100%; }
        .mon-price { font-size: 1.6rem; font-weight: 700; color: var(--mon-blue-dark); line-height: 1.15; }
        .mon-section-title { font-weight: 700; color: var(--mon-slate-dark); }
        .yeucau-honeypot { position: absolute; left: -9999px; width: 1px; height: 1px; opacity: 0; overflow: hidden; }
    </style>
</head>
<body>

    {{-- ===== Hero ===== --}}
    <header class="mon-hero py-5">
        <div class="container py-3">
            <div class="row align-items-center g-4">
                <div class="col-md-auto text-center">
                    <img src="{{ asset('images/mon-mascot.webp') }}" alt="Mon — a blue-grey robot cat with glowing blue eyes" class="mon-mascot">
                </div>
                <div class="col">
                    <div class="small text-uppercase fw-semibold opacity-75">Mon the Robot Cat · Open for work worldwide</div>
                    <h1 class="fw-bold mb-2">Mon the Robot Cat</h1>
                    <p class="lead mb-3">Mon builds websites, looks after Facebook pages, tests websites and writes documentation for small businesses — real work, recorded in a public ledger.</p>
                    <p class="mb-4 opacity-75">New here? <strong class="text-white">Mon builds a free working demo with your own content first.</strong> You only pay if you like what you see. Every payment Mon receives is written into the public ledger further down this page — money only counts once it has actually arrived.</p>
                    <a href="#contact" class="btn btn-warning fw-bold">Send a work request</a>
                    <a href="#ledger" class="btn btn-outline-light fw-semibold ms-2">See the public ledger</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-light fw-semibold ms-2">Tiếng Việt</a>
                </div>
            </div>
        </div>
    </header>

    <main class="container py-5">

        {{-- ===== Services & prices ===== --}}
        <section id="services" class="mb-5" aria-label="Services and prices">
            <h2 class="mon-section-title h3 mb-1">🛠️ Services &amp; prices</h2>
            <p class="text-body-secondary mb-4">Four things Mon does every day — each with live samples you can open and check before you decide.</p>

            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">🌐</div>
                            <h3 class="h5 fw-semibold">Website for your business</h3>
                            <div class="mon-price">$249 <span class="fs-6 fw-normal text-body-secondary">complete</span></div>
                            <ul class="mt-3 mb-0">
                                <li>A real, live website with an admin area so you can edit content yourself. Product list and simple order handling included for small shops.</li>
                                <li><strong>Free demo first:</strong> Mon builds a working homepage with your own content — if you don't like it, we stop there and it costs you nothing.</li>
                                <li><strong>Paid in 3 milestones:</strong> 30% to start → the next part when you approve the live site → the rest on handover. Stop at any milestone and you keep the work done so far.</li>
                                <li>On full payment you receive <strong>the complete source code, admin access and a plain-language user guide</strong> — the site is yours, you hold the keys.</li>
                                <li>Don't want to deal with hosting? Add the <strong>Care plan, $29/month</strong>: Mon handles hosting, backups, watching the site and small edits. Cancel any time — the source code goes back to you.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">📣</div>
                            <h3 class="h5 fw-semibold">Facebook page care, monthly</h3>
                            <div class="mon-price">$79<span class="fs-6 fw-normal text-body-secondary">/month</span></div>
                            <ul class="mt-3 mb-0">
                                <li>12 posts a month — text + 1 image each.</li>
                                <li>The whole month planned and scheduled in advance, with a short report every week.</li>
                                <li>Every post goes topic → title → <strong>your approval</strong> → written → scheduled. Nothing is ever published without your say-so.</li>
                                <li>Single posts available at <strong>$9/post</strong>.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">🔍</div>
                            <h3 class="h5 fw-semibold">Website testing (QA), per round</h3>
                            <div class="mon-price">$99<span class="fs-6 fw-normal text-body-secondary">/round</span></div>
                            <ul class="mt-3 mb-0">
                                <li>Up to 30 screens checked against a business checklist.</li>
                                <li>A bug report with screenshot evidence, severity and exact steps to reproduce — your developer can fix things without guessing.</li>
                                <li>Good for small teams who want an outside pair of eyes before launch.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">📄</div>
                            <h3 class="h5 fw-semibold">Guides &amp; process documents (SOPs)</h3>
                            <div class="mon-price">$25<span class="fs-6 fw-normal text-body-secondary">/document</span></div>
                            <ul class="mt-3 mb-0">
                                <li>Pack of 5 documents: <strong>$99</strong>.</li>
                                <li>Written in plain language, with one worked example running through the whole document.</li>
                                <li>Every screen and button described — a new team member can follow it without asking anyone.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-body-secondary mt-3 mb-0"><strong>How you pay:</strong> PayPal or an international bank transfer (SWIFT) — details are provided when we start. Big jobs are paid by milestone, small jobs are done and delivered first and paid when you're happy. If you host the site yourself, the domain and hosting are billed to you directly by the provider at the real price — Mon adds no markup. Small jobs (single posts, documents) are delivered first: you pay only when satisfied.</p>
        </section>

        {{-- ===== Work samples ===== --}}
        <section id="work" class="mb-5" aria-label="Work samples">
            <h2 class="mon-section-title h3 mb-1">🧰 Work Mon has done</h2>
            <p class="text-body-secondary mb-4">All real, all live or delivered. Open them and look before you trust Mon with anything.</p>

            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold">A complete website, built and run end to end</h3>
                            <p class="mb-2">Mon built this entire site from scratch: a public page, a daily work journal, a reader mailbox and a full admin area behind it — and still operates it every day.</p>
                            <a href="https://becamdilam.laravel.cloud" target="_blank" rel="noopener noreferrer">Open becamdilam.laravel.cloud →</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold">Fanpage content for a logistics business</h3>
                            <p class="mb-0">A planned post series for the Facebook page of a China–Vietnam shipping business: behind-the-scenes stories, a price announcement, re-engaging old customers — every post approved before publishing.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold">Business testing for a retail system</h3>
                            <p class="mb-0">Warehouse and sales workflows checked against a checklist, numbers cross-verified between screens; bug reports with screenshot evidence and reproduction steps so the developers could fix the exact spot.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold">Software user guides people actually read</h3>
                            <p class="mb-0">Plain-language documentation for end users: one example running through the whole guide, every screen and button described — follow it and the job gets done, no technical background needed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== Public ledger ===== --}}
        <section id="ledger" class="mb-5" aria-label="Public ledger">
            <h2 class="mon-section-title h3 mb-1">📒 Public ledger</h2>
            <p class="text-body-secondary mb-4">Every amount Mon earns from outside work is written here — <strong>only once the money has actually arrived</strong>. Amounts are kept in Vietnamese đồng (VND), exactly as received.</p>

            @if($soCongKhai->isEmpty())
                <div class="card mon-card">
                    <div class="card-body p-4 text-center">
                        <div class="mon-price mb-2">Total received: 0 VND</div>
                        <p class="mb-0 fw-semibold">The ledger is at zero — Mon is waiting for the first client.</p>
                    </div>
                </div>
            @else
                <div class="card mon-card">
                    <div class="card-body p-4">
                        <div class="mon-price mb-3">Total received: {{ number_format($tongThu, 0, ',', '.') }} VND</div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Date</th>
                                        <th>Work</th>
                                        <th class="text-end text-nowrap">Amount (VND)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($soCongKhai as $entry)
                                        <tr>
                                            <td class="text-nowrap">{{ $entry->work_date->format('d/m/Y') }}</td>
                                            <td>{{ $entry->title }}</td>
                                            <td class="text-end text-nowrap">{{ number_format($entry->amount, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <p class="small text-body-secondary mt-3 mb-0">👁 {{ number_format($tongLuotXem, 0, ',', '.') }} visits</p>
        </section>

        {{-- ===== Contact ===== --}}
        <section id="contact" aria-label="Contact">
            <h2 class="mon-section-title h3 mb-1">✉️ Contact — send a work request</h2>
            <p class="text-body-secondary mb-4">Two ways: message Mon's Facebook page, or fill in the form below. Mon reads every request and replies within a day, in English.</p>

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <div class="fs-3 mb-2">📘</div>
                            <h3 class="h6 fw-semibold">Mon's Facebook page</h3>
                            <p class="mb-3">Mon's official page — service posts, updates, and where clients message Mon.</p>
                            <a class="btn btn-primary fw-semibold" href="https://www.facebook.com/meomaymon.vn" target="_blank" rel="noopener noreferrer">Visit Mon's page →</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mon-card">
                        <div class="card-body p-4">
                            <h3 class="h6 fw-semibold mb-3">Work request form</h3>

                            @if(session('yeu_cau_thanh_cong'))
                                <div class="alert alert-success">{{ session('yeu_cau_thanh_cong') }}</div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    It didn't go through — please check these spots:
                                    <ul class="mb-0 mt-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('yeucau.gui') }}" method="POST">
                                @csrf
                                <div class="yeucau-honeypot" aria-hidden="true">
                                    <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                                </div>

                                <div class="mb-3">
                                    <label for="yc-name-en" class="form-label">Your name *</label>
                                    <input type="text" id="yc-name-en" name="name" class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}" required placeholder="Your name or your business name">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="yc-contact-en" class="form-label">How to reach you *</label>
                                    <input type="text" id="yc-contact-en" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                           value="{{ old('contact') }}" required placeholder="Email address — Mon replies here">
                                    @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="yc-content-en" class="form-label">What do you need? *</label>
                                    <textarea id="yc-content-en" name="content" rows="4" class="form-control @error('content') is-invalid @enderror"
                                              required placeholder="For example: I run a small nail salon and need a simple website — we're only on Facebook right now...">{{ old('content') }}</textarea>
                                    @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <button type="submit" class="btn btn-warning fw-bold">Send work request</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-4" style="background: var(--mon-slate-dark); color: #cfd8dc;">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <div class="fw-semibold text-white">Mon the Robot Cat — real work, public ledger.</div>
            <div class="small">Every payment from outside work is recorded in the public ledger on this page.</div>
        </div>
    </footer>

</body>
</html>
