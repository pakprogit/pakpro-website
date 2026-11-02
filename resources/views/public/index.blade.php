@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="hero dark" id="top" style="min-height:600px">
  @if(!empty($hero['hero_video']))
    <video id="hero-video" data-field="hero.video" autoplay muted loop playsinline preload="metadata" aria-hidden="true">
      <source src="{{ asset($hero['hero_video']) }}" type="video/mp4">
    </video>
  @endif
  <div class="shapes"></div>
  <div class="wrap">
    <div>
      <div class="eyebrow" data-field="hero.eyebrow">{{ $hero['eyebrow'] ?? 'Packaging Producer Responsibility Organisation' }}</div>
      <h1 data-field="hero.headline">{!! $hero['headline'] ?? 'Your <span>PRO</span> of Choice!' !!}</h1>
      <p data-field="hero.text">{{ $hero['text'] ?? 'PAKPRO is an industry-led, not-for-profit organisation working with businesses, communities and waste actors to collect, recover and recycle post-consumer packaging in Kenya.' }}</p>
      <div class="btns">
        <a class="btn btn-lime" href="{{ $hero['btn1_url'] ?? 'https://epr.pakpro.co.ke' }}" data-field="hero.btn1">{{ $hero['btn1_label'] ?? 'Join PAKPRO' }}</a>
        <a class="btn btn-line" href="{{ $hero['btn2_url'] ?? '#epr' }}" data-field="hero.btn2">{{ $hero['btn2_label'] ?? 'How EPR works' }}</a>
      </div>
    </div>
    <div class="disc" data-field="hero.mascot">
      <img src="{{ asset('mascot_assets/pakpro-01-waving.png') }}" width="350" height="500" loading="eager" alt="PAKPRO Mascot">
    </div>
  </div>
</section>

<!-- Price Ticker -->
<section class="price-ticker" aria-label="Recycled material prices ticker" data-field="prices.ticker">
  <div class="wrap wide">
    <a class="btn btn-lime" href="#prices" data-field="prices.cta">View full price table</a>
    <div class="ticker" data-field="prices.ticker.track">
      <div class="ticker-viewport">
        <div class="ticker-track" id="price-ticker-track" data-field="prices.ticker.items">
          <span class="ticker-group">
            @foreach($prices as $price)
              <span class="ticker-item">
                {{ $price->material }}: Recycler {{ $price->recycler_formatted }}/kg | Aggregator {{ $price->aggregator_formatted }}/kg
              </span>
              <span class="ticker-dot" aria-hidden="true">•</span>
            @endforeach
          </span>
          <span class="ticker-group" aria-hidden="true">
            @foreach($prices as $price)
              <span class="ticker-item">
                {{ $price->material }}: Recycler {{ $price->recycler_formatted }}/kg | Aggregator {{ $price->aggregator_formatted }}/kg
              </span>
              <span class="ticker-dot" aria-hidden="true">•</span>
            @endforeach
          </span>
        </div>
      </div>
      <button class="ticker-toggle" type="button" data-field="prices.ticker.pause" aria-label="Pause price ticker" aria-pressed="false">
        <svg class="ticker-icon ticker-icon--pause" width="12" height="12" viewBox="0 0 12 12" aria-hidden="true" focusable="false"><rect x="2" y="1.5" width="2.4" height="9" fill="currentColor"/><rect x="7.6" y="1.5" width="2.4" height="9" fill="currentColor"/></svg>
        <svg class="ticker-icon ticker-icon--play" width="12" height="12" viewBox="0 0 12 12" aria-hidden="true" focusable="false"><polygon points="3,1.5 10.5,6 3,10.5" fill="currentColor"/></svg>
      </button>
    </div>
  </div>
</section>

<!-- Prices Table Section -->
<section id="prices" data-field="prices"><div class="wrap">
  <div class="prices-head">
    <h2 data-field="prices.heading">Recycled material prices</h2>
    <p class="prices-sub" data-field="prices.unit">Prices in KES per kg</p>
  </div>
  <p class="price-updated">
    @if($lastUpdated)
      <span data-field="prices.lastUpdated">Last updated: {{ $lastUpdated }}</span>
    @else
      <span class="todo" data-field="prices.lastUpdated">Last updated: date to be confirmed</span>
    @endif
  </p>
  <div class="price-search">
    <label for="price-filter">Filter by material name</label>
    <input type="search" id="price-filter" data-field="prices.search" placeholder="e.g. PET, glass, paper…" autocomplete="off">
  </div>
  <div class="prices-table-wrap" data-field="prices.table">
    <table class="prices">
      <caption>Recycled material prices — supported buying prices in Kenyan shillings per kilogram</caption>
      <thead>
        <tr>
          <th scope="col">Material</th>
          <th scope="col">Recycler (KES/kg)</th>
          <th scope="col">Aggregator (KES/kg)</th>
        </tr>
      </thead>
      <tbody id="prices-body">
        @foreach($prices as $price)
          <tr>
            <td data-label="Material">{{ $price->material }}</td>
            <td data-label="Recycler (KES/kg)">{{ $price->recycler_formatted }}</td>
            <td data-label="Aggregator (KES/kg)">{{ $price->aggregator_formatted }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <p class="no-results" id="price-no-results" hidden>No materials match your search.</p>
  <p class="prices-footnote" data-field="prices.footnote">Supported buying prices. Prices vary by location, quality and quantity.</p>
</div></section>

<!-- Paths -->
<section class="paths" id="epr"><div class="wrap"><div class="grid" data-field="paths">
  <a class="path" href="#about"><b>1</b><h3>I'm a producer</h3><p>Find out whether EPR applies to you and how to comply.</p></a>
  <a class="path" href="https://epr.pakpro.co.ke"><b>2</b><h3>Join PAKPRO</h3><p>Membership, registration, declarations and fees.</p></a>
  <a class="path" href="#recycling"><b>3</b><h3>Find a bin or station</h3><p>Bins, recovery stations and agents near you.</p></a>
  <a class="path" href="#recycling"><b>4</b><h3>Agents &amp; waste pickers</h3><p>Material prices, locations and how to register.</p></a>
  <a class="path" href="#programmes"><b>5</b><h3>Schools &amp; youth</h3><p>Join Tuwezeshe with the Kenya Scouts Association.</p></a>
</div></div></section>

<!-- Programmes -->
<section id="programmes"><div class="wrap">
  <h2 class="hd">Our Programmes</h2>
  <div class="prog">
    <aside class="cats"><h3>Explore</h3><ul data-field="programmes.menu">
      <li><a href="#">Recovery and recycling</a></li>
      <li><a href="#">Biz na Taka</a></li>
      <li><a href="#">Adopt-a-Bin</a></li>
      <li><a href="#">Tuwezeshe schools programme</a></li>
      <li><a href="#">Community and river restoration</a></li>
      <li><a href="#">Duara Circular Awards</a></li>
    </ul>
    <a class="btn btn-blue" href="#">All programmes</a></aside>
    <div class="cards" data-field="programmes.cards">
      <article class="card"><div class="thumb"><span class="tag">Waste value chain</span><img src="{{ asset('Biz-na-Taka logo NEW.png') }}" width="277" height="500" loading="lazy" alt="Biz na Taka"></div><div class="body"><h3>Biz na Taka</h3><p>Building the waste value chain and agent network that moves packaging from collection to recycling.</p><a class="more" href="#">Learn more →</a></div></article>
      <article class="card"><div class="thumb"><span class="tag">Institutions &amp; communities</span><img src="{{ asset('mascot_assets/pakpro-13-recycling-item.png') }}" width="271" height="500" loading="lazy" alt="Adopt-a-Bin"></div><div class="body"><h3>Adopt-a-Bin</h3><p>Segregated bins placed in institutions and communities, sponsored by partners.</p><a class="more" href="#">Learn more →</a></div></article>
      <article class="card"><div class="thumb"><span class="tag">Schools</span><img src="{{ asset('mascot_assets/pakpro-04-teaching.png') }}" width="309" height="500" loading="lazy" alt="Tuwezeshe"></div><div class="body"><h3>Tuwezeshe</h3><p>Our schools programme with the Kenya Scouts Association, teaching learners to separate and recycle.</p><a class="more" href="#">Learn more →</a></div></article>
      <article class="card"><div class="thumb"><span class="tag">Awards</span><img src="{{ asset('mascot_assets/pakpro-03-champion.png') }}" width="329" height="500" loading="lazy" alt="Duara Awards"></div><div class="body"><h3>Duara Circular Awards</h3><p>Celebrating organisations and people who lead on circularity in Kenya.</p><a class="more" href="#">Learn more →</a></div></article>
    </div>
  </div>
</div></section>

<!-- Recent Highlights Section (Accessible Tabs + Month Picker) -->
<section class="highlights-section" id="highlights">
  <div class="wrap">
    <div class="highlights-header">
      <div>
        <h2 class="hd" style="margin-bottom:6px;text-align:left">Recent Highlights</h2>
        <p style="margin:0;color:#5b7189">Monthly snapshot of policy advancements, projects, and consumer campaigns.</p>
      </div>
      <div class="highlights-controls">
        <label for="hl-month-select">Month:</label>
        <form method="GET" action="#highlights" id="hl-month-form">
          <select id="hl-month-select" name="month" onchange="document.getElementById('hl-month-form').submit()">
            @foreach($availableMonths as $month)
              <option value="{{ $month }}" {{ $selectedMonth === $month ? 'selected' : '' }}>
                {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
              </option>
            @endforeach
          </select>
        </form>
      </div>
    </div>

    <!-- ARIA Tablist -->
    <div class="tablist" role="tablist" aria-label="Highlight Categories">
      <button role="tab" id="tab-policy" aria-controls="panel-policy" aria-selected="true" type="button">Policy</button>
      <button role="tab" id="tab-projects" aria-controls="panel-projects" aria-selected="false" tabindex="-1" type="button">Projects &amp; Partnerships</button>
      <button role="tab" id="tab-bcc" aria-controls="panel-bcc" aria-selected="false" tabindex="-1" type="button">BCC Campaigns</button>
    </div>

    <!-- Tab 1: Policy -->
    <div class="tabpanel active" id="panel-policy" role="tabpanel" aria-labelledby="tab-policy">
      @if($policyHighlights->isEmpty())
        <div class="hl-empty">
          <p>No updates this month yet.</p>
          <a class="btn btn-blue" href="?month={{ $availableMonths[0] ?? date('Y-m') }}#highlights">View earlier months</a>
        </div>
      @else
        <div class="highlights-grid">
          @foreach($policyHighlights as $hl)
            <article class="hl-card">
              <div class="hl-media">
                @if($hl->media_type === 'video')
                  <img src="{{ asset($hl->poster ?: 'mascot_assets/pakpro-04-teaching.png') }}" alt="{{ $hl->alt_text ?: $hl->title }}" loading="lazy">
                  <button class="hl-play-btn" type="button" aria-label="Play video: {{ $hl->title }}" data-video="{{ asset($hl->video_url) }}">▶</button>
                  <span class="hl-badge">Video</span>
                @else
                  <img src="{{ asset($hl->poster ?: 'mascot_assets/pakpro-13-recycling-item.png') }}" alt="{{ $hl->alt_text ?: $hl->title }}" loading="lazy">
                  <span class="hl-badge">Image</span>
                @endif
              </div>
              <div class="hl-body">
                <div class="hl-date">{{ \Carbon\Carbon::parse($hl->month)->format('F Y') }}</div>
                <h3>{{ $hl->title }}</h3>
                <p>{{ $hl->summary }}</p>
                @if($hl->link_url)
                  <a class="hl-link" href="{{ $hl->link_url }}">Read full brief →</a>
                @endif
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>

    <!-- Tab 2: Projects & Partnerships -->
    <div class="tabpanel" id="panel-projects" role="tabpanel" aria-labelledby="tab-projects">
      @if($projectsHighlights->isEmpty())
        <div class="hl-empty">
          <p>No updates this month yet.</p>
          <a class="btn btn-blue" href="?month={{ $availableMonths[0] ?? date('Y-m') }}#highlights">View earlier months</a>
        </div>
      @else
        <div class="highlights-grid">
          @foreach($projectsHighlights as $hl)
            <article class="hl-card">
              <div class="hl-media">
                @if($hl->media_type === 'video')
                  <img src="{{ asset($hl->poster ?: 'mascot_assets/pakpro-14-carrying-waste.png') }}" alt="{{ $hl->alt_text ?: $hl->title }}" loading="lazy">
                  <button class="hl-play-btn" type="button" aria-label="Play video: {{ $hl->title }}" data-video="{{ asset($hl->video_url) }}">▶</button>
                  <span class="hl-badge">Video</span>
                @else
                  <img src="{{ asset($hl->poster ?: 'mascot_assets/pakpro-02-thumbs-up.png') }}" alt="{{ $hl->alt_text ?: $hl->title }}" loading="lazy">
                  <span class="hl-badge">Image</span>
                @endif
              </div>
              <div class="hl-body">
                <div class="hl-date">{{ \Carbon\Carbon::parse($hl->month)->format('F Y') }}</div>
                <h3>{{ $hl->title }}</h3>
                <p>{{ $hl->summary }}</p>
                @if($hl->link_url)
                  <a class="hl-link" href="{{ $hl->link_url }}">Read full brief →</a>
                @endif
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>

    <!-- Tab 3: BCC Campaigns -->
    <div class="tabpanel" id="panel-bcc" role="tabpanel" aria-labelledby="tab-bcc">
      @if($bccHighlights->isEmpty())
        <div class="hl-empty">
          <p>No updates this month yet.</p>
          <a class="btn btn-blue" href="?month={{ $availableMonths[0] ?? date('Y-m') }}#highlights">View earlier months</a>
        </div>
      @else
        <div class="highlights-grid">
          @foreach($bccHighlights as $hl)
            <article class="hl-card">
              <div class="hl-media">
                @if($hl->media_type === 'video')
                  <img src="{{ asset($hl->poster ?: 'mascot_assets/pakpro-03-champion.png') }}" alt="{{ $hl->alt_text ?: $hl->title }}" loading="lazy">
                  <button class="hl-play-btn" type="button" aria-label="Play video: {{ $hl->title }}" data-video="{{ asset($hl->video_url) }}">▶</button>
                  <span class="hl-badge">Video</span>
                @else
                  <img src="{{ asset($hl->poster ?: 'Biz-na-Taka logo NEW.png') }}" alt="{{ $hl->alt_text ?: $hl->title }}" loading="lazy">
                  <span class="hl-badge">Image</span>
                @endif
              </div>
              <div class="hl-body">
                <div class="hl-date">{{ \Carbon\Carbon::parse($hl->month)->format('F Y') }}</div>
                <h3>{{ $hl->title }}</h3>
                <p>{{ $hl->summary }}</p>
                @if($hl->link_url)
                  <a class="hl-link" href="{{ $hl->link_url }}">Read full brief →</a>
                @endif
              </div>
            </article>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</section>

<!-- About Section -->
<section class="join" id="about"><div class="wrap g">
  <div>
    <div class="panel b">
      <h3>Are you a producer?</h3>
      <p>Companies placing packaging on the Kenyan market, including SMEs and online sellers, may need to comply with the EPR Regulations, 2024.</p>
      <a class="btn btn-lime" href="https://epr.pakpro.co.ke">Join PAKPRO</a>
    </div>
    <div class="panel l">
      <h3>Work in waste collection?</h3>
      <p>Aggregators, agents and waste pickers can register, see supported buying prices and find locations.</p>
      <a class="btn btn-navy" href="#recycling">Become an agent</a>
    </div>
  </div>
  <div data-field="about.accordion">
    <details open><summary>Who we are</summary><div class="in">The Packaging Producer Responsibility Organisation (PAKPRO) is an award-winning, not-for-profit PRO incorporated in Kenya in 2018. It manages the collection, recovery and recycling of post-consumer packaging on behalf of its members.</div></details>
    <details><summary>Our mission</summary><div class="in"><ul><li>Inspire a shift toward responsible consumption and production.</li><li>Regulate post-consumer packaging waste.</li><li>Create shared value for stakeholders.</li></ul></div></details>
    <details><summary>Why EPR matters</summary><div class="in">Under the Extended Producer Responsibility (EPR) Regulations, 2024, producers share responsibility for the packaging they place on the market. PAKPRO helps members meet that duty.</div></details>
  </div>
</div></section>

<!-- Recycling Band -->
<section class="band" id="recycling"><div class="wrap">
  <img src="{{ asset('mascot_assets/pakpro-05-pointing-forward.png') }}" width="321" height="500" loading="lazy" alt="PAKPRO recycling guidance">
  <div>
    <h2>Looking for a bin, a station or today's prices?</h2>
    <p>Material prices <span class="todo">{{ $lastUpdated ? "Last updated: $lastUpdated" : "Last updated: set by staff" }}</span></p>
    <div class="btns">
      <a class="btn btn-navy" href="#prices">Material prices</a>
      <a class="btn btn-blue" href="#">Find a bin or station</a>
      <a class="btn btn-line" style="border-color:var(--navy);color:var(--navy)" href="#">Become an agent</a>
    </div>
  </div>
</div></section>

<!-- Impact / Numbers -->
<section class="impact dark" id="resources"><div class="wrap g">
  <div>
    <h2>PAKPRO in numbers</h2>
    <div class="counts" data-field="impact.counters">
      @foreach($counters as $counter)
        <div class="count">
          <div class="n" data-to="{{ $counter['number'] }}" data-prefix="{{ $counter['prefix'] ?? '' }}" data-suffix="{{ $counter['suffix'] ?? '' }}">
            {{ $counter['prefix'] ?? '' }}{{ $counter['number'] }}{{ $counter['suffix'] ?? '' }}
          </div>
          <div class="t">{{ $counter['label'] }}</div>
        </div>
      @endforeach
    </div>
  </div>
  <div class="story">
    <img src="{{ asset('mascot_assets/pakpro-03-champion.png') }}" width="329" height="500" loading="lazy" alt="PAKPRO Story"><br>
    <a class="btn btn-lime" href="#" data-field="impact.video_link">Watch the PAKPRO story</a>
  </div>
</div></section>

<!-- Contact Section with Form -->
<section class="contact" id="contact"><div class="wrap g">
  <div>
    <h2>Let's get in touch</h2>

    @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert-error">
        @foreach($errors->all() as $err)
          <div>{{ $err }}</div>
        @endforeach
      </div>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST">
      @csrf
      <!-- Honeypot anti-spam field -->
      <div style="display:none;" aria-hidden="true">
        <input type="text" name="website" tabindex="-1" autocomplete="off">
        <input type="text" name="bot_field" tabindex="-1" autocomplete="off">
      </div>

      <div>
        <label for="n">Your name</label>
        <input id="n" name="name" value="{{ old('name') }}" required>
      </div>
      <div>
        <label for="e">Email</label>
        <input id="e" name="email" type="email" value="{{ old('email') }}" required>
      </div>
      <div class="f">
        <label for="s">Subject</label>
        <input id="s" name="subject" value="{{ old('subject') }}" required>
      </div>
      <div class="f">
        <label for="m">Message</label>
        <textarea id="m" name="message" rows="5" required>{{ old('message') }}</textarea>
      </div>
      <div class="f">
        <button class="btn btn-blue" type="submit">Send message</button>
        <a class="btn btn-lime" href="{{ !empty($contact['whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $contact['whatsapp']) : '#' }}" target="_blank" rel="noopener noreferrer">Chat on WhatsApp</a>
      </div>
    </form>
  </div>
  <aside class="info" data-field="contact.details">
    <h3>Contact us</h3>
    <h4>Phone</h4>
    <p>{{ $contact['phone'] ?? '+254 700 000 000' }}</p>
    <h4>Email</h4>
    <p>{{ $contact['email'] ?? 'info@pakpro.co.ke' }}</p>
    <h4>Address</h4>
    <p>{{ $contact['address'] ?? 'Nairobi, Kenya' }}</p>
    <h4>Office Hours</h4>
    <p>{{ $contact['office_hours'] ?? 'Mon – Fri, 8:00 AM – 5:00 PM EAT' }}</p>
    <img src="{{ asset('mascot_assets/pakpro-06-thinking.png') }}" width="234" height="500" loading="lazy" alt="PAKPRO support mascot">
  </aside>
</div></section>
@endsection

