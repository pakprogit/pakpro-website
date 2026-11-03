<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>PAKPRO Kenya | Your PRO of Choice!</title>
<meta name="description" content="PAKPRO is Kenya's industry-led, not-for-profit producer responsibility organisation for post-consumer packaging.">
<style>
@font-face{font-family:Inter;font-weight:400;font-display:swap;src:url(/assets/fonts/inter-latin-400-normal.woff2) format("woff2")}
@font-face{font-family:Inter;font-weight:600;font-display:swap;src:url(/assets/fonts/inter-latin-600-normal.woff2) format("woff2")}
@font-face{font-family:Inter;font-weight:700;font-display:swap;src:url(/assets/fonts/inter-latin-700-normal.woff2) format("woff2")}
@font-face{font-family:Inter;font-weight:800;font-display:swap;src:url(/assets/fonts/inter-latin-800-normal.woff2) format("woff2")}
html{-webkit-text-size-adjust:100%}
:root{--blue:#1474BB;--lime:#D4DF22;--navy:#0B2E4F;--ink:#12263A;--tint:#EEF4FA;--font:Inter,Aptos,"Segoe UI",Calibri,Arial,sans-serif}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;font-family:var(--font);color:var(--ink);line-height:1.55;background:#fff}
img{max-width:100%;height:auto}a{color:var(--blue)}:focus-visible{outline:3px solid var(--navy);outline-offset:2px}.dark :focus-visible{outline-color:var(--lime)}
.skip{position:absolute;left:-999px}.skip:focus{left:8px;top:8px;background:#fff;padding:8px 12px;z-index:99}
.wrap{max-width:1180px;margin:auto;padding:0 20px}.wrap.wide{max-width:1400px}.hero .wrap>*{min-width:0}section{padding:72px 0}h1,h2,h3,h4{line-height:1.15;margin:0 0 .5em;color:var(--navy)}
h2{font-size:clamp(1.7rem,3vw,2.3rem)}h2.hd{text-align:center;margin-bottom:40px}h2.hd:after{content:"";display:block;width:64px;height:5px;border-radius:3px;background:var(--lime);margin:14px auto 0}
.btn{display:inline-block;padding:12px 24px;border-radius:999px;font-weight:700;text-decoration:none;border:2px solid transparent;cursor:pointer;font:inherit;font-weight:700}
.btn-lime{background:var(--lime);color:var(--navy)}.btn-blue{background:var(--blue);color:#fff}.btn-line{border-color:#fff;color:#fff}.btn-navy{background:var(--navy);color:#fff}
.topbar{background:var(--navy);color:#fff;font-size:.85rem;padding:6px 0}.topbar .wrap{display:flex;justify-content:space-between;gap:12px}.topbar a{color:var(--lime);text-decoration:none;font-weight:600}
.marquee{display:flex;align-items:center;gap:8px;flex:1 1 auto;min-width:0;line-height:1.4}
.marquee-viewport{overflow:hidden;flex:1 1 auto;min-width:0}
.marquee-track{display:flex;white-space:nowrap;width:max-content;animation:marquee-scroll 30s linear infinite;will-change:transform}
.marquee-group{display:inline-flex;align-items:center;white-space:nowrap;flex:0 0 auto}
.marquee-item{flex:0 0 auto}
.marquee-dot{flex:0 0 auto;color:var(--lime);margin:0 10px;font-weight:700}
.marquee-toggle{flex:0 0 auto;display:inline-flex;align-items:center;justify-content:center;width:22px;height:18px;background:rgba(255,255,255,.14);color:#fff;border:0;border-radius:6px;cursor:pointer;padding:0;font:inherit}
.marquee-toggle:hover{background:rgba(255,255,255,.26)}
.marquee-icon--play{display:none}
.marquee-toggle.is-paused .marquee-icon--pause{display:none}
.marquee-toggle.is-paused .marquee-icon--play{display:inline}
.marquee:hover .marquee-track,.marquee:focus-within .marquee-track{animation-play-state:paused}
.marquee-track.paused{animation-play-state:paused}
@keyframes marquee-scroll{from{transform:translateX(0)}to{transform:translateX(-50%)}}
@media(prefers-reduced-motion:reduce){.marquee-track{animation:none!important}.marquee-group+.marquee-group{display:none}.marquee-dot{display:none}.marquee-item~.marquee-item{display:none}.marquee-toggle{display:none}}
.price-ticker{background:var(--navy);color:#fff;border-bottom:3px solid var(--lime);padding:10px 0}
.price-ticker .wrap.wide{display:flex;align-items:center;gap:14px;min-height:44px}
.price-ticker .btn{padding:8px 14px;font-size:.85rem;flex:0 0 auto;white-space:nowrap}
.ticker{display:flex;align-items:center;gap:8px;flex:1 1 auto;min-width:0;line-height:1.4}
.ticker-viewport{overflow:hidden;flex:1 1 auto;min-width:0}
.ticker-track{display:flex;white-space:nowrap;width:max-content;animation:ticker-scroll 50s linear infinite;will-change:transform}
.ticker-group{display:inline-flex;align-items:center;white-space:nowrap;flex:0 0 auto}
.ticker-item{flex:0 0 auto}
.ticker-dot{flex:0 0 auto;color:var(--lime);margin:0 14px;font-weight:700}
.ticker-toggle{flex:0 0 auto;display:inline-flex;align-items:center;justify-content:center;width:22px;height:20px;background:rgba(255,255,255,.14);color:#fff;border:0;border-radius:6px;cursor:pointer;padding:0;font:inherit}
.ticker-toggle:hover{background:rgba(255,255,255,.26)}
.ticker-icon--play{display:none}
.ticker-toggle.is-paused .ticker-icon--pause{display:none}
.ticker-toggle.is-paused .ticker-icon--play{display:inline}
.ticker:hover .ticker-track,.ticker:focus-within .ticker-track{animation-play-state:paused}
.ticker-track.paused{animation-play-state:paused}
@keyframes ticker-scroll{from{transform:translateX(0)}to{transform:translateX(-50%)}}
@media(prefers-reduced-motion:reduce){.ticker-track{animation:none!important}.ticker-group+.ticker-group{display:none}.ticker-dot{display:none}.ticker-item~.ticker-item{display:none}.ticker-toggle{display:none}}
#prices{background:var(--tint)}
#prices .wrap{max-width:1180px}
.prices-head{display:flex;align-items:baseline;flex-wrap:wrap;gap:8px 16px;margin-bottom:6px}
.prices-head h2{margin:0}
.prices-sub{margin:0 0 14px;color:#3d5268;font-weight:600}
.price-updated{margin:0 0 18px}
.price-updated .todo{font-weight:700}
.price-search{margin-bottom:18px;max-width:360px}
.price-search label{display:block;font-weight:600;font-size:.9rem;margin-bottom:5px;color:var(--navy)}
#price-filter{width:100%;padding:11px 14px;border:2px solid #c3d3e4;border-radius:10px;font:inherit;background:#fff}
#price-filter:focus{border-color:var(--blue);outline:none;box-shadow:0 0 0 3px rgba(20,116,187,.18)}
.prices-table-wrap{border-radius:14px;overflow:hidden;box-shadow:0 6px 22px rgba(11,46,79,.10);background:#fff;border:1px solid #e2eaf3}
table.prices{width:100%;border-collapse:collapse;font-size:.96rem}
table.prices caption{padding:12px 16px;text-align:left;font-weight:600;color:#3d5268;font-size:.9rem}
table.prices th,table.prices td{padding:13px 16px;text-align:left;border-bottom:1px solid #e2eaf3}
table.prices thead th{background:#eaf1f8;color:var(--navy);font-weight:700;font-size:.88rem;white-space:nowrap}
table.prices tbody tr:last-child td{border-bottom:0}
table.prices tbody td:first-child{font-weight:600;color:var(--navy)}
table.prices tbody tr:hover{background:#f4f8fc}
.no-results{margin-top:14px;padding:18px;color:#5b7189;background:#fff;border:1px solid #e2eaf3;border-radius:10px;text-align:center}
.prices-footnote{margin:16px 0 0;font-size:.88rem;color:#5b7189}
@media(max-width:700px){.prices-table-wrap{border-radius:12px;overflow:visible;box-shadow:none;border:0;background:transparent}table.prices thead{display:none}table.prices tbody,table.prices tr,table.prices td{display:block;width:100%}table.prices tbody tr{margin:0 0 14px;padding:14px 16px;border:1px solid #d3e0ee;border-radius:12px;background:#fff;box-shadow:0 4px 14px rgba(11,46,79,.08)}table.prices tbody td{padding:5px 0;border:0}table.prices tbody td:first-child{font-weight:700;font-size:1.05rem;padding-bottom:8px;margin-bottom:4px;border-bottom:1px solid #eef4fa}table.prices tbody td:not(:first-child):before{content:attr(data-label) ": ";font-weight:700;color:var(--navy)}}
header{position:sticky;top:0;z-index:50;background:#fff;box-shadow:0 2px 12px rgba(11,46,79,.12)}header .wrap{display:flex;align-items:center;justify-content:space-between;height:76px;gap:16px}
.brand{display:flex;align-items:center;gap:10px;text-decoration:none;color:var(--navy);font-weight:800;font-size:1.25rem}.brand img{display:block;width:160px;height:auto;max-height:58px;object-fit:contain}
nav ul{display:flex;gap:4px;list-style:none;margin:0;padding:0}nav a{display:block;white-space:nowrap;padding:10px 14px;color:var(--navy);font-weight:600;text-decoration:none;border-radius:8px;font-size:.95rem}nav a:hover{background:var(--tint)}
.hdr-cta{display:flex;gap:8px;white-space:nowrap}.hdr-cta .btn{padding:9px 16px;font-size:.9rem}.menu-btn{display:none;background:var(--navy);color:#fff;border:0;border-radius:8px;padding:10px 14px;font:inherit;font-weight:700}
.hero{position:relative;color:#fff;overflow:hidden;padding:0;background:linear-gradient(135deg,var(--navy),var(--blue));min-height:600px;display:flex;align-items:center}
.hero video{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}.hero:before{content:"";position:absolute;inset:0;z-index:1;background:linear-gradient(90deg,rgba(11,46,79,.93) 25%,rgba(11,46,79,.55))}
.hero .wrap{position:relative;z-index:2;display:grid;grid-template-columns:1.3fr .7fr;gap:30px;align-items:center;padding-top:60px;padding-bottom:60px}.hero h1{color:#fff;font-size:clamp(2.2rem,4.4vw,3.7rem);text-wrap:balance}.hero h1 span{color:var(--lime)}
.eyebrow{color:var(--lime);font-weight:700;letter-spacing:.12em;text-transform:uppercase;font-size:.85rem;margin-bottom:12px}.hero p{font-size:1.15rem;max-width:560px;margin:0 0 26px}.hero .btns{display:flex;gap:12px;flex-wrap:wrap}
.shapes{position:absolute;inset:0;z-index:1;pointer-events:none;background:linear-gradient(112deg,transparent 56%,rgba(20,116,187,.6) 56%,rgba(20,116,187,.6) 80%,var(--lime) 80%,var(--lime) 84%,transparent 84%)}
.rail{position:fixed;right:0;top:50%;transform:translateY(-50%);z-index:40;display:flex;flex-direction:column;background:var(--navy);border-radius:14px 0 0 14px;overflow:hidden;box-shadow:-4px 4px 16px rgba(0,0,0,.25)}.rail a,.rail button{color:#fff;text-decoration:none;font-weight:700;font-size:.8rem;padding:16px 14px;text-align:center;border-bottom:1px solid rgba(255,255,255,.15);display:block;width:100%;background:transparent;border-left:0;border-right:0;border-top:0;cursor:pointer;font-family:var(--font)}.rail a:hover,.rail button:hover{background:var(--lime);color:var(--navy)}

/* Prices Modal */
.prices-modal-overlay{position:fixed;inset:0;z-index:200;background:rgba(11,46,79,.72);backdrop-filter:blur(3px);display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;pointer-events:none;transition:opacity .25s}
.prices-modal-overlay.open{opacity:1;pointer-events:all}
.prices-modal{background:#fff;border-radius:20px;width:100%;max-width:780px;max-height:90vh;display:flex;flex-direction:column;box-shadow:0 24px 60px rgba(11,46,79,.28);transform:translateY(20px);transition:transform .25s}
.prices-modal-overlay.open .prices-modal{transform:translateY(0)}
.prices-modal-head{display:flex;align-items:flex-start;justify-content:space-between;padding:24px 28px 16px;border-bottom:2px solid #e2eaf3;flex-shrink:0}
.prices-modal-head h2{margin:0;font-size:1.55rem;color:var(--navy)}
.prices-modal-head p{margin:4px 0 0;font-size:.9rem;color:#5b7189}
.prices-modal-close{background:transparent;border:2px solid #c3d3e4;color:var(--navy);border-radius:50%;width:38px;height:38px;font-size:1.3rem;cursor:pointer;display:grid;place-items:center;flex-shrink:0;transition:background .15s,color .15s}
.prices-modal-close:hover{background:var(--navy);color:#fff;border-color:var(--navy)}
.prices-modal-search{padding:16px 28px 12px;flex-shrink:0}
.prices-modal-search label{display:block;font-weight:600;font-size:.88rem;color:var(--navy);margin-bottom:5px}
.prices-modal-search input{width:100%;padding:11px 14px;border:2px solid #c3d3e4;border-radius:10px;font:inherit;font-size:.95rem}
.prices-modal-search input:focus{border-color:var(--blue);outline:none;box-shadow:0 0 0 3px rgba(20,116,187,.18)}
.prices-modal-body{overflow-y:auto;padding:0 28px 24px;flex:1 1 auto}
.prices-modal-meta{font-size:.85rem;color:#5b7189;margin:0 0 14px}
.prices-modal-no-results{text-align:center;padding:28px;color:#5b7189;font-size:.97rem}
.prices-modal table{width:100%;border-collapse:collapse;font-size:.95rem}
.prices-modal table thead th{background:#eaf1f8;color:var(--navy);font-weight:700;font-size:.86rem;padding:11px 14px;text-align:left;white-space:nowrap;border-bottom:2px solid #d3e0ee;position:sticky;top:0;z-index:1}
.prices-modal table tbody td{padding:11px 14px;border-bottom:1px solid #e2eaf3;text-align:left}
.prices-modal table tbody tr:last-child td{border-bottom:0}
.prices-modal table tbody td:first-child{font-weight:600;color:var(--navy)}
.prices-modal table tbody tr:hover{background:#f4f8fc}
.prices-modal-foot{padding:14px 28px 20px;border-top:2px solid #e2eaf3;flex-shrink:0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px}
.prices-modal-foot p{margin:0;font-size:.84rem;color:#5b7189}
@media(max-width:600px){.prices-modal-head,.prices-modal-search,.prices-modal-body,.prices-modal-foot{padding-left:18px;padding-right:18px}.prices-modal table thead{display:none}.prices-modal table tbody tr{display:block;margin-bottom:12px;border:1px solid #e2eaf3;border-radius:10px;padding:12px 14px}.prices-modal table tbody td{display:block;border:0;padding:4px 0}.prices-modal table tbody td:first-child{font-size:1.02rem;padding-bottom:6px;border-bottom:1px solid #eef4fa;margin-bottom:4px}.prices-modal table tbody td:not(:first-child):before{content:attr(data-label) ": ";font-weight:700;color:var(--navy)}}
.disc{position:relative;width:min(380px,80vw);aspect-ratio:1;margin:auto;border-radius:50%;background:#fff;box-shadow:0 0 0 12px var(--lime);display:grid;place-items:center;overflow:hidden}.disc img{display:block;width:100%;height:100%;object-fit:contain;margin:0}
.paths{padding:0;margin-top:0;position:relative;z-index:5}.paths .grid{display:grid;grid-template-columns:repeat(5,1fr);gap:16px}
.path{background:#fff;border-radius:16px;padding:22px 18px;box-shadow:0 10px 30px rgba(11,46,79,.15);text-decoration:none;color:var(--ink);border-top:5px solid var(--lime);transition:transform .2s}.path:hover{transform:translateY(-4px)}
.path b{display:inline-grid;place-items:center;width:38px;height:38px;border-radius:50%;background:var(--blue);color:#fff;margin-bottom:10px}.path h3{font-size:1.05rem}.path p{margin:0;font-size:.92rem;color:#3d5268}
.prog{display:grid;grid-template-columns:1fr 2.1fr;gap:30px}.cats{background:var(--tint);border-radius:16px;padding:26px;align-self:start}.cats ul{list-style:none;padding:0;margin:0 0 20px}.cats li a{display:block;padding:10px 0;border-bottom:1px solid #d3e0ee;color:var(--navy);text-decoration:none;font-weight:600}
.cards{display:grid;grid-template-columns:1fr 1fr;gap:22px}.card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 6px 22px rgba(11,46,79,.12)}
.card .thumb{background:#fff;height:180px;display:grid;place-items:end center;position:relative;overflow:hidden}.card .thumb img{height:92%;width:auto;object-fit:contain}.tag{position:absolute;left:14px;top:14px;background:var(--lime);color:var(--navy);font-weight:700;font-size:.78rem;padding:4px 12px;border-radius:999px}
.card .body{padding:18px 20px 22px}.card h3{font-size:1.2rem}.card p{margin:0 0 10px;color:#3d5268;font-size:.95rem}.card a.more{font-weight:700;text-decoration:none}
.join{background:var(--tint)}.join .g{display:grid;grid-template-columns:1fr 1fr;gap:36px;align-items:center}.panel{border-radius:16px;padding:28px;margin-bottom:20px}.panel.b{background:var(--blue);color:#fff}.panel.b h3{color:#fff}.panel.l{background:var(--lime);color:var(--navy)}
.panel p{margin:0 0 16px}details{background:#fff;border-radius:12px;margin-bottom:10px;box-shadow:0 2px 10px rgba(11,46,79,.08)}summary{cursor:pointer;padding:16px 20px;font-weight:700;color:var(--navy);list-style:none;display:flex;justify-content:space-between}summary:after{content:"+";color:var(--blue);font-size:1.3rem;line-height:1}details[open] summary:after{content:"–"}details .in{padding:0 20px 18px}details ul{margin:0;padding-left:20px}
.band{background:var(--lime);padding:44px 0}.band .wrap{display:flex;align-items:center;gap:30px;flex-wrap:wrap;justify-content:center}.band img{height:170px;width:170px;object-fit:contain;border-radius:50%;background:#fff}.band h2{margin-bottom:6px}.band p{margin:0 0 16px;color:var(--navy)}.band .btns{display:flex;gap:10px;flex-wrap:wrap}

/* Highlights Accessible Tabs & Cards */
.highlights-section{background:#fff;padding:60px 0}
.highlights-header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:28px}
.highlights-header h2{margin:0}
.highlights-controls{display:flex;align-items:center;gap:12px}
.highlights-controls label{font-weight:600;font-size:.92rem;color:var(--navy)}
.highlights-controls select{padding:8px 14px;border:2px solid #c3d3e4;border-radius:8px;font:inherit;background:#fff;color:var(--navy)}
.tablist{display:flex;gap:8px;border-bottom:2px solid #e2eaf3;margin-bottom:32px;overflow-x:auto}
.tablist button{padding:12px 22px;border:0;background:transparent;color:#5b7189;font-weight:700;font-size:1rem;cursor:pointer;border-bottom:3px solid transparent;margin-bottom:-2px;white-space:nowrap;font-family:inherit}
.tablist button:hover{color:var(--navy)}
.tablist button[aria-selected="true"]{color:var(--navy);border-bottom-color:var(--blue);background:var(--tint);border-radius:8px 8px 0 0}
.tabpanel{display:none}
.tabpanel.active{display:block}
.highlights-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.hl-card{border-radius:14px;overflow:hidden;border:1px solid #e2eaf3;box-shadow:0 4px 16px rgba(11,46,79,.08);background:#fff;display:flex;flex-direction:column}
.hl-media{position:relative;aspect-ratio:16/9;background:var(--tint);display:grid;place-items:center;overflow:hidden}
.hl-media img{width:100%;height:100%;object-fit:cover}
.hl-media video{width:100%;height:100%;object-fit:cover}
.hl-play-btn{position:absolute;width:52px;height:52px;border-radius:50%;background:rgba(11,46,79,.85);color:var(--lime);border:0;display:grid;place-items:center;cursor:pointer;font-size:1.4rem;box-shadow:0 4px 12px rgba(0,0,0,.3);transition:transform .2s}
.hl-play-btn:hover{transform:scale(1.1)}
.hl-badge{position:absolute;top:10px;right:10px;background:var(--lime);color:var(--navy);font-size:.74rem;font-weight:800;padding:3px 9px;border-radius:6px;text-transform:uppercase}
.hl-body{padding:20px;flex:1 1 auto;display:flex;flex-direction:column}
.hl-date{font-size:.82rem;color:#5b7189;margin-bottom:6px;font-weight:600}
.hl-card h3{font-size:1.15rem;margin:0 0 10px;color:var(--navy)}
.hl-card p{margin:0 0 16px;color:#3d5268;font-size:.92rem;flex:1 1 auto}
.hl-link{color:var(--blue);font-weight:700;text-decoration:none;font-size:.9rem}
.hl-empty{text-align:center;padding:48px 20px;background:var(--tint);border-radius:12px;color:#5b7189}
.hl-empty p{font-size:1.05rem;margin:0 0 14px}

.events-section{--event-accent:#80384b;--event-ink:#321824}.events-section h2.hd:after{background:var(--event-accent)}.events-intro{text-align:center;color:#5b7189;margin:-22px auto 44px;max-width:760px}.events-filters{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;max-width:860px;margin:0 auto 24px}.events-filters label{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}.events-filters select{width:100%;min-height:50px;border:1px solid #d5d5d5;border-radius:9px;padding:0 16px;background:#fff;color:var(--ink);font:inherit}.events-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:24px 20px}.event-card{min-height:244px;display:grid;grid-template-columns:100px minmax(0,1fr);overflow:hidden;border-radius:12px;background:#fff;box-shadow:0 6px 20px rgba(26,21,24,.08)}.event-date{display:flex;flex-direction:column;justify-content:center;align-items:center;padding:18px 8px;background:var(--event-accent);color:#fff;text-align:center}.event-date .month{font-size:.9rem;font-weight:700;text-transform:uppercase}.event-date .day{font-size:2rem;font-weight:800;line-height:1.25}.event-date .year{font-size:.88rem;font-weight:600}.event-body{min-width:0;padding:24px;display:flex;flex-direction:column;align-items:flex-start}.event-category{display:inline-block;margin-bottom:12px;padding:5px 13px;border-radius:999px;background:#e6f3ff;color:#075ca5;font-size:.76rem;font-weight:700;text-transform:uppercase}.event-category[data-category="Sports"]{background:#e8f4e9;color:#168137}.event-category[data-category="Arts"]{background:#ffebef;color:#c0263b}.event-category[data-category="Community"]{background:#fff2df;color:#c65310}.event-card h3{margin:0 0 8px;color:var(--event-ink);font-size:1.2rem}.event-card p{margin:0 0 14px;color:#5b7189;font-size:.94rem}.event-details{display:flex;flex-wrap:wrap;gap:8px 18px;margin-top:auto;color:#687588;font-size:.84rem}.event-actions{display:flex;flex-wrap:wrap;gap:10px;margin-top:18px}.event-actions a{display:inline-flex;align-items:center;justify-content:center;min-height:42px;padding:8px 18px;border:1px solid var(--event-accent);border-radius:999px;color:var(--event-accent);font-weight:700;text-decoration:none}.event-actions .event-learn{background:var(--event-accent);color:#fff}.event-actions a:hover{filter:brightness(.92)}.events-empty{grid-column:1/-1;padding:26px;border-radius:12px;background:#f7f8fa;color:#5b7189;text-align:center}.events-home{padding-top:48px}.events-home .events-grid{margin-bottom:26px}.events-home .events-more{display:block;width:max-content;margin:0 auto;border:1px solid var(--event-accent);border-radius:999px;padding:10px 20px;color:var(--event-accent);font-weight:700;text-decoration:none}.events-home .events-filters{display:none}
.impact{background:var(--navy);color:#fff}.impact h2{color:#fff}.impact .g{display:grid;grid-template-columns:1.3fr .7fr;gap:40px;align-items:center}.counts{display:grid;grid-template-columns:1fr 1fr;gap:18px}
.count{background:rgba(255,255,255,.08);border-radius:16px;padding:22px;border-left:5px solid var(--lime)}.count .n{font-size:2.6rem;font-weight:800;color:var(--lime);line-height:1}.count .t{margin-top:6px}.story{text-align:center}.story img{height:230px;width:230px;object-fit:contain;border-radius:50%;background:#fff}.story .btn{margin-top:12px}
.contact .g{display:grid;grid-template-columns:2fr 1fr;gap:36px}form{display:grid;grid-template-columns:1fr 1fr;gap:14px}form .f{grid-column:span 2}label{font-weight:600;font-size:.9rem;display:block;margin-bottom:4px;color:var(--navy)}
input,textarea{width:100%;padding:12px 14px;border:2px solid #c3d3e4;border-radius:10px;font:inherit}input:focus,textarea:focus{border-color:var(--blue);outline:none}.info{background:var(--tint);border-radius:16px;padding:26px;position:relative}.info h4{margin:14px 0 2px;font-size:.95rem}.info p{margin:0}.info img{height:150px;width:150px;object-fit:contain;border-radius:50%;background:#fff;display:block;margin:16px auto 0}
.todo{color:#8a5a00;background:#fff4d6;border-radius:6px;padding:1px 8px;font-size:.9rem}footer{background:#071f36;color:#cfdcea;padding:34px 0;font-size:.92rem}footer .wrap{display:flex;justify-content:space-between;gap:20px;flex-wrap:wrap}footer a{color:#fff;margin-right:16px}footer b{color:var(--lime)}
.alert-success{background:#e8f7ee;border:1px solid #94d3a2;color:#18612d;padding:14px 18px;border-radius:10px;margin-bottom:18px;font-weight:600}
.alert-error{background:#fde8e8;border:1px solid #f8b4b4;color:#9b1c1c;padding:14px 18px;border-radius:10px;margin-bottom:18px;font-weight:600}

@media(max-width:1100px){.shapes,.rail{display:none}.paths .grid{grid-template-columns:repeat(2,1fr)}.hero .wrap,.prog,.join .g,.impact .g,.contact .g{grid-template-columns:1fr}.hero .disc{display:grid;width:min(270px,72vw);margin:12px auto 0}.highlights-grid{grid-template-columns:1fr}.menu-btn{display:block}.hdr-cta{display:none}
nav{position:absolute;left:0;right:0;top:76px;background:#fff;box-shadow:0 10px 20px rgba(0,0,0,.1);display:none}nav.open{display:block}nav ul{flex-direction:column;padding:10px 20px}}
@media(max-width:600px){.cards,.counts,form{grid-template-columns:1fr}form .f{grid-column:auto}.paths .grid{grid-template-columns:1fr}section{padding:52px 0}}
@media(max-width:760px){.events-filters{grid-template-columns:1fr;margin-bottom:20px}.events-grid{grid-template-columns:1fr;gap:16px}.events-intro{margin-bottom:28px}.event-card{grid-template-columns:78px minmax(0,1fr);min-height:0}.event-body{padding:18px 16px}.event-date .day{font-size:1.75rem}.event-actions a{padding:8px 14px}.events-home{padding-top:34px}}
@media(max-width:420px){.event-card{grid-template-columns:68px minmax(0,1fr)}.event-body{padding:16px 13px}.event-actions{gap:8px}.event-actions a{min-height:40px;padding:7px 11px;font-size:.88rem}}
@media(prefers-reduced-motion:reduce){*{transition:none!important;scroll-behavior:auto!important}}
</style>
</head>
<body>
<a class="skip" href="#main">Skip to content</a>

<div class="topbar dark"><div class="wrap wide">
  <div class="marquee" data-field="topbar.marquee">
    <div class="marquee-viewport"><div class="marquee-track" data-field="topbar.marquee.track">
      <span class="marquee-group">
        @foreach($marqueeItems as $item)
          <span class="marquee-item" data-field="topbar.marquee.item">{{ $item }}</span>
          <span class="marquee-dot" data-field="topbar.marquee.dot" aria-hidden="true">•</span>
        @endforeach
      </span>
      <span class="marquee-group" aria-hidden="true">
        @foreach($marqueeItems as $item)
          <span class="marquee-item" data-field="topbar.marquee.item">{{ $item }}</span>
          <span class="marquee-dot" data-field="topbar.marquee.dot" aria-hidden="true">•</span>
        @endforeach
      </span>
    </div></div>
    <button class="marquee-toggle" type="button" data-field="topbar.marquee.pause" aria-label="Pause marquee" aria-pressed="false">
      <svg class="marquee-icon marquee-icon--pause" width="12" height="12" viewBox="0 0 12 12" aria-hidden="true" focusable="false"><rect x="2" y="1.5" width="2.4" height="9" fill="currentColor"/><rect x="7.6" y="1.5" width="2.4" height="9" fill="currentColor"/></svg>
      <svg class="marquee-icon marquee-icon--play" width="12" height="12" viewBox="0 0 12 12" aria-hidden="true" focusable="false"><polygon points="3,1.5 10.5,6 3,10.5" fill="currentColor"/></svg>
    </button>
  </div>
  <span><a href="{{ url('/admin') }}">My PAKPRO login</a> &nbsp;|&nbsp; <a href="#">Kiswahili</a></span>
</div></div>

<header><div class="wrap wide">
  <a class="brand" href="#top" data-field="site.logo"><img src="/logo/PAKPRO%20Logo_No%20background.png" width="800" height="320" loading="eager" alt="PAKPRO Packaging Producer Responsibility Organisation"></a>
  <nav id="nav" aria-label="Main"><ul>
    <li><a href="#about">About</a></li>
    <li><a href="#epr">EPR &amp; Compliance</a></li>
    <li><a href="#programmes">Programmes</a></li>
    <li><a href="#prices" data-field="nav.prices">Prices</a></li>
    <li><a href="#highlights" data-field="nav.highlights">Highlights</a></li>
    <li><a href="#events">Events</a></li>
    <li><a href="#recycling">Recycling</a></li>
    <li><a href="#resources">Resources</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul></nav>
  <div class="hdr-cta"><a class="btn btn-lime" href="https://epr.pakpro.co.ke">Join PAKPRO</a></div>
  <button class="menu-btn" aria-controls="nav" aria-expanded="false">Menu</button>
</div></header>

<main id="main">
  @yield('content')
</main>

<footer><div class="wrap">
  <div><b>PAKPRO</b> — Your PRO of Choice!<br>© <span id="yr">{{ date('Y') }}</span> Packaging Producer Responsibility Organisation.</div>
  <div>
    <a href="https://www.nema.go.ke" target="_blank" rel="noopener noreferrer">NEMA</a>
    <a href="#">Privacy policy</a>
    <a href="#">Terms</a>
    <a href="#">Disclaimer</a>
  </div>
</div></footer>

<aside class="rail" aria-label="Quick actions">
  <a href="https://epr.pakpro.co.ke">Join</a>
  <button type="button" id="rail-prices-btn" data-field="rail.prices" aria-haspopup="dialog" aria-controls="prices-modal">Prices</button>
  <a href="#highlights">Highlights</a>
  <a href="#contact">Chat</a>
</aside>

<!-- Prices Modal -->
<div class="prices-modal-overlay" id="prices-modal" role="dialog" aria-modal="true" aria-labelledby="prices-modal-title" hidden>
  <div class="prices-modal">
    <div class="prices-modal-head">
      <div>
        <h2 id="prices-modal-title">Recycled material prices</h2>
        <p>Supported buying prices in Kenyan shillings per kilogram</p>
      </div>
      <button class="prices-modal-close" type="button" id="prices-modal-close" aria-label="Close prices">✕</button>
    </div>
    <div class="prices-modal-search">
      <label for="prices-modal-filter">Filter by material name</label>
      <input type="search" id="prices-modal-filter" placeholder="e.g. PET, glass, paper…" autocomplete="off">
    </div>
    <div class="prices-modal-body">
      <p class="prices-modal-meta" id="prices-modal-meta">
        @if(isset($lastUpdated) && $lastUpdated)
          Last updated: {{ $lastUpdated }}
        @else
          Prices updated regularly
        @endif
      </p>
      <table aria-label="Recycled material prices">
        <thead>
          <tr>
            <th scope="col">Material</th>
            <th scope="col">Recycler (KES/kg)</th>
            <th scope="col">Aggregator (KES/kg)</th>
          </tr>
        </thead>
        <tbody id="prices-modal-body">
          @foreach($prices as $price)
            <tr>
              <td data-label="Material">{{ $price->material }}</td>
              <td data-label="Recycler (KES/kg)">{{ $price->recycler_formatted }}</td>
              <td data-label="Aggregator (KES/kg)">{{ $price->aggregator_formatted }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <p class="prices-modal-no-results" id="prices-modal-no-results" hidden>No materials match your search.</p>
    </div>
    <div class="prices-modal-foot">
      <p>Prices vary by location, quality and quantity.</p>
      <a class="btn btn-blue" href="#prices" id="prices-modal-full-link">View full price table ↓</a>
    </div>
  </div>
</div>

<script>
// Hero video: skip on small screens, data-saver and reduced motion. Poster/gradient shows instead.
(function(){
  var v=document.getElementById("hero-video"),c=navigator.connection||{};
  if(v&&(matchMedia("(max-width:768px)").matches||c.saveData||matchMedia("(prefers-reduced-motion:reduce)").matches))v.remove();
  var b=document.querySelector(".menu-btn"),n=document.getElementById("nav");
  if(b&&n){
    b.onclick=function(){var o=n.classList.toggle("open");b.setAttribute("aria-expanded",o)};
    n.addEventListener("click",function(){n.classList.remove("open")});
  }
  if(!matchMedia("(prefers-reduced-motion:reduce)").matches&&"IntersectionObserver"in window){
    var io=new IntersectionObserver(function(es){
      es.forEach(function(e){
        if(!e.isIntersecting)return;
        io.unobserve(e.target);
        var el=e.target,to=+el.dataset.to,p=el.dataset.prefix||"",s=el.dataset.suffix||"",t0=performance.now();
        (function f(t){var k=Math.min(1,(t-t0)/1200);el.textContent=p+Math.round(to*k)+(k<1?"":s);if(k<1)requestAnimationFrame(f)})(t0)
      })
    },{threshold:.5});
    document.querySelectorAll(".n[data-to]").forEach(function(x){if(x.dataset.to!="2018")io.observe(x)});
  }
})();

// Top-bar marquee Pause/Play
(function(){
  var btn=document.querySelector(".marquee-toggle");
  if(!btn)return;
  var track=document.querySelector(".marquee-track");
  var paused=false;
  function setPaused(p){
    paused=p;
    btn.classList.toggle("is-paused",p);
    btn.setAttribute("aria-pressed",String(p));
    btn.setAttribute("aria-label",p?"Play marquee":"Pause marquee");
    if(track)track.classList.toggle("paused",p);
  }
  btn.addEventListener("click",function(){setPaused(!paused)});
})();

// Price ticker Pause/Play and Filter
(function(){
  var filter=document.getElementById("price-filter");
  var tbody=document.getElementById("prices-body");
  var noResults=document.getElementById("price-no-results");
  if(filter&&tbody){
    filter.addEventListener("input",function(){
      var q=filter.value.trim().toLowerCase();
      var rows=tbody.querySelectorAll("tr");
      var any=false;
      rows.forEach(function(r){
        var m=r.cells[0].textContent.toLowerCase();
        var show=!q||m.indexOf(q)!==-1;
        r.style.display=show?"":"none";
        if(show)any=true;
      });
      if(noResults)noResults.hidden=any;
    });
  }

  var btn=document.querySelector(".ticker-toggle");
  var track=document.getElementById("price-ticker-track");
  if(btn&&track){
    var paused=false;
    btn.addEventListener("click",function(){
      paused=!paused;
      btn.classList.toggle("is-paused",paused);
      btn.setAttribute("aria-pressed",String(paused));
      btn.setAttribute("aria-label",paused?"Play price ticker":"Pause price ticker");
      track.classList.toggle("paused",paused);
    });
  }
})();

// Highlights Accessible Tabs, Arrow Keys & Hash Navigation
(function(){
  var tablist = document.querySelector('.tablist');
  if(!tablist) return;
  var tabs = Array.from(tablist.querySelectorAll('button[role="tab"]'));
  var panels = Array.from(document.querySelectorAll('.tabpanel'));

  function activateTab(tab, updateHash){
    tabs.forEach(function(t){
      t.setAttribute('aria-selected', 'false');
      t.setAttribute('tabindex', '-1');
    });
    panels.forEach(function(p){
      p.classList.remove('active');
    });
    tab.setAttribute('aria-selected', 'true');
    tab.removeAttribute('tabindex');
    var targetPanel = document.getElementById(tab.getAttribute('aria-controls'));
    if(targetPanel) targetPanel.classList.add('active');
    if(updateHash) {
      history.replaceState(null, '', '#' + tab.id.replace('tab-', ''));
    }
  }

  tabs.forEach(function(tab, index){
    tab.addEventListener('click', function(){
      activateTab(tab, true);
    });

    tab.addEventListener('keydown', function(e){
      var newIndex = index;
      if(e.key === 'ArrowRight'){
        newIndex = (index + 1) % tabs.length;
      } else if(e.key === 'ArrowLeft'){
        newIndex = (index - 1 + tabs.length) % tabs.length;
      } else if(e.key === 'Home'){
        newIndex = 0;
      } else if(e.key === 'End'){
        newIndex = tabs.length - 1;
      } else {
        return;
      }
      e.preventDefault();
      tabs[newIndex].focus();
      activateTab(tabs[newIndex], true);
    });
  });

  // Activate tab based on URL hash (e.g. #projects or #bcc)
  var hash = window.location.hash.replace('#', '');
  if(hash){
    var matchingTab = document.getElementById('tab-' + hash);
    if(matchingTab){
      activateTab(matchingTab, false);
    }
  }

  // Video click-to-play deferred loading
  document.querySelectorAll('.hl-play-btn').forEach(function(btn){
    btn.addEventListener('click', function(){
      var mediaContainer = btn.closest('.hl-media');
      var videoSrc = btn.getAttribute('data-video');
      if(!mediaContainer || !videoSrc) return;
      var video = document.createElement('video');
      video.src = videoSrc;
      video.controls = true;
      video.autoplay = true;
      video.playsInline = true;
      video.style.width = '100%';
      video.style.height = '100%';
      video.style.objectFit = 'cover';
      mediaContainer.replaceChildren(video);
    });
  });
})();

// Prices Modal
(function(){
  var overlay = document.getElementById('prices-modal');
  var openBtn = document.getElementById('rail-prices-btn');
  var closeBtn = document.getElementById('prices-modal-close');
  var filter = document.getElementById('prices-modal-filter');
  var tbody = document.getElementById('prices-modal-body');
  var noResults = document.getElementById('prices-modal-no-results');
  var fullLink = document.getElementById('prices-modal-full-link');
  if(!overlay) return;

  // Keep track of element focused before modal opened
  var lastFocus = null;

  function openModal(){
    lastFocus = document.activeElement;
    overlay.removeAttribute('hidden');
    // Force reflow so transition plays
    overlay.offsetHeight;
    overlay.classList.add('open');
    if(closeBtn) closeBtn.focus();
    document.body.style.overflow = 'hidden';
  }

  function closeModal(){
    overlay.classList.remove('open');
    overlay.addEventListener('transitionend', function done(){
      overlay.setAttribute('hidden', '');
      overlay.removeEventListener('transitionend', done);
    });
    document.body.style.overflow = '';
    if(lastFocus) lastFocus.focus();
    // Reset search
    if(filter) filter.value = '';
    resetRows();
  }

  function resetRows(){
    if(!tbody) return;
    tbody.querySelectorAll('tr').forEach(function(r){ r.style.display = ''; });
    if(noResults) noResults.hidden = true;
  }

  // All buttons/links that open the modal
  [
    document.getElementById('rail-prices-btn'),
    document.getElementById('ticker-prices-btn'),
    document.getElementById('nav-prices-btn'),
    document.getElementById('band-prices-btn'),
  ].forEach(function(btn){
    if(!btn) return;
    btn.addEventListener('click', function(e){ e.preventDefault(); openModal(); });
  });

  if(closeBtn) closeBtn.addEventListener('click', closeModal);

  // Click outside modal content closes it
  overlay.addEventListener('click', function(e){
    if(e.target === overlay) closeModal();
  });

  // Escape key closes it
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape' && overlay.classList.contains('open')) closeModal();
  });

  // Filter rows
  if(filter && tbody){
    filter.addEventListener('input', function(){
      var q = filter.value.trim().toLowerCase();
      var rows = tbody.querySelectorAll('tr');
      var any = false;
      rows.forEach(function(r){
        var m = r.cells[0] ? r.cells[0].textContent.toLowerCase() : '';
        var show = !q || m.indexOf(q) !== -1;
        r.style.display = show ? '' : 'none';
        if(show) any = true;
      });
      if(noResults) noResults.hidden = any;
    });
  }

  // Footer close link
  if(fullLink){
    fullLink.addEventListener('click', function(e){
      e.preventDefault();
      closeModal();
    });
  }

  // Trap focus inside modal
  overlay.addEventListener('keydown', function(e){
    if(e.key !== 'Tab') return;
    var focusable = Array.from(overlay.querySelectorAll(
      'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    )).filter(function(el){ return !el.disabled && el.offsetParent !== null; });
    if(!focusable.length) return;
    var first = focusable[0], last = focusable[focusable.length - 1];
    if(e.shiftKey){
      if(document.activeElement === first){ e.preventDefault(); last.focus(); }
    } else {
      if(document.activeElement === last){ e.preventDefault(); first.focus(); }
    }
  });
})();
</script>
</body>
</html>

