const ALL_STUDENTS = window.ALL_STUDENTS || [];

const JURUSAN_COLOR = {
    RPL: { dot: 'bg-blue-500', bar: 'bg-blue-500', hex: '#3b82f6' },
    TKJ: { dot: 'bg-violet-500', bar: 'bg-violet-500', hex: '#8b5cf6' },
    AKL: { dot: 'bg-emerald-500', bar: 'bg-emerald-500', hex: '#10b981' },
    DKV: { dot: 'bg-amber-500', bar: 'bg-amber-500', hex: '#f59e0b' },
    'Tata Boga': { dot: 'bg-rose-500', bar: 'bg-rose-500', hex: '#f43f5e' },
};
const FALLBACK_HEX = ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#f43f5e'];
const PAGE_SIZE = 5;
let currentPage = 1;
let filtered = [...ALL_STUDENTS];

function scoreBarColor(score) {
    if (score >= 0.90) return 'bg-blue-500';
    if (score >= 0.85) return 'bg-violet-500';
    if (score >= 0.80) return 'bg-emerald-500';
    return 'bg-slate-400';
}

function badgeRank1(rec) {
    return `
        <div class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-blue-50 border border-blue-100">
          <span class="w-4 h-4 rounded bg-blue-600 text-white text-[10px] font-medium flex items-center justify-center flex-shrink-0">1</span>
          <div>
            <p class="text-[11px] font-medium text-blue-800 leading-none">${rec.j}</p>
            <p class="text-[10px] text-blue-400 mt-0.5 leading-none">${rec.s.toFixed(2)}</p>
          </div>
        </div>`;
}

function badgeRank2(rec) {
    return `
        <div class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-violet-50 border border-violet-100">
          <span class="w-4 h-4 rounded bg-violet-600 text-white text-[10px] font-medium flex items-center justify-center flex-shrink-0">2</span>
          <div>
            <p class="text-[11px] font-medium text-violet-800 leading-none">${rec.j}</p>
            <p class="text-[10px] text-violet-400 mt-0.5 leading-none">${rec.s.toFixed(2)}</p>
          </div>
        </div>`;
}

function badgeRank3(rec) {
    return `
        <div class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-slate-100 border border-slate-200">
          <span class="w-4 h-4 rounded bg-slate-500 text-white text-[10px] font-medium flex items-center justify-center flex-shrink-0">3</span>
          <div>
            <p class="text-[11px] font-medium text-slate-600 leading-none">${rec.j}</p>
            <p class="text-[10px] text-slate-400 mt-0.5 leading-none">${rec.s.toFixed(2)}</p>
          </div>
        </div>`;
}

function renderTable() {
    const totalPages = Math.max(1, Math.ceil(filtered.length / PAGE_SIZE));
    if (currentPage > totalPages) currentPage = totalPages;
    const start = (currentPage - 1) * PAGE_SIZE;
    const pageData = filtered.slice(start, start + PAGE_SIZE);
    const tbody = document.getElementById('tableBody');

    if (!tbody) return;

    if (pageData.length === 0) {
        tbody.innerHTML = `<tr><td colspan="3" class="text-center py-10 text-sm text-slate-400">Tidak ada siswa ditemukan.</td></tr>`;
    } else {
        tbody.innerHTML = pageData
            .map((student) => {
                const top = student.recs[0];
                const pct = Math.round(top.s * 100);
                const bc = scoreBarColor(top.s);

                return `
          <tr class="hover:bg-slate-50/60 transition">
            <td class="py-5 pr-6">
              <p class="text-sm font-medium text-slate-800">${student.name}</p>
              <p class="text-xs text-slate-400 mt-0.5 font-mono">${student.id}</p>
            </td>
            <td class="py-5 pr-6">
              <div class="flex items-center gap-2 flex-wrap">
                ${badgeRank1(student.recs[0])}
                ${student.recs[1] ? badgeRank2(student.recs[1]) : ''}
                ${student.recs[2] ? badgeRank3(student.recs[2]) : ''}
              </div>
            </td>
            <td class="py-5">
              <p class="text-xl font-medium text-slate-800 tracking-tight">${pct}%</p>
              <div class="w-28 h-0.5 rounded-full bg-slate-100 mt-2">
                <div class="h-full ${bc} rounded-full" style="width:${pct}%"></div>
              </div>
            </td>
          </tr>`;
            })
            .join('');
    }

    renderPagination(totalPages);
    renderChart();
}

function renderPagination(totalPages) {
    const start = (currentPage - 1) * PAGE_SIZE + 1;
    const end = Math.min(currentPage * PAGE_SIZE, filtered.length);
    const ctrl = document.getElementById('paginationControls');

    if (!ctrl) return;

    const infoText = filtered.length > 0 ? `${start}–${end} dari ${filtered.length} siswa` : '0 dari 0 siswa';

    const prevDisabled = currentPage === 1 ? 'opacity-40 cursor-not-allowed pointer-events-none' : 'hover:bg-slate-50 cursor-pointer';
    const nextDisabled = currentPage === totalPages || totalPages === 0 ? 'opacity-40 cursor-not-allowed pointer-events-none' : 'hover:bg-slate-50 cursor-pointer';

    let pageButtons = '';
    for (let i = 1; i <= totalPages; i += 1) {
        const active = i === currentPage ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50 cursor-pointer';
        pageButtons += `<button onclick="changePage(${i})" class="w-8 h-8 rounded-lg border text-xs font-medium transition ${active}">${i}</button>`;
    }

    ctrl.innerHTML = `
        <span class="text-xs text-slate-400 mr-2">${infoText}</span>
        <button onclick="changePage(${currentPage - 1})" class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition ${prevDisabled}">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </button>
        ${pageButtons}
        <button onclick="changePage(${currentPage + 1})" class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition ${nextDisabled}">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </button>`;
}

function changePage(page) {
    const totalPages = Math.ceil(filtered.length / PAGE_SIZE);
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    renderTable();
}

function renderChart() {
    const svg = document.getElementById('donutSvg');
    const legend = document.getElementById('legend');
    const summaryRow = document.getElementById('summaryRow');

    if (!svg || !legend || !summaryRow) return;

    if (ALL_STUDENTS.length === 0) {
        svg.innerHTML = '';
        document.getElementById('donutNum').textContent = '0';
        legend.innerHTML = '<p class="text-sm text-slate-400">Belum ada data.</p>';
        summaryRow.innerHTML = '';
        return;
    }

    const dist = ALL_STUDENTS.reduce((acc, student) => {
        const jurusan = student.recs[0].j;
        acc[jurusan] = (acc[jurusan] || 0) + 1;
        return acc;
    }, {});

    const entries = Object.entries(dist).sort((a, b) => b[1] - a[1]);
    const total = ALL_STUDENTS.length;
    const R = 70;
    const cx = 90;
    const cy = 90;
    const circumference = 2 * Math.PI * R;

    let offset = 0;
    svg.innerHTML = entries
        .map(([jurusan, count], index) => {
            const color = JURUSAN_COLOR[jurusan] ? JURUSAN_COLOR[jurusan].hex : FALLBACK_HEX[index % FALLBACK_HEX.length];
            const frac = count / total;
            const dash = frac * circumference;
            const gap = circumference - dash;
            const circle = `<circle cx="${cx}" cy="${cy}" r="${R}" fill="none" stroke="${color}" stroke-width="26" stroke-dasharray="${dash.toFixed(2)} ${gap.toFixed(2)}" stroke-dashoffset="${(-offset).toFixed(2)}" stroke-linecap="butt"/>`;
            offset += dash;
            return circle;
        })
        .join('');

    document.getElementById('donutNum').textContent = `${entries.length}`;

    legend.innerHTML = entries
        .map(([jurusan, count], index) => {
            const color = JURUSAN_COLOR[jurusan] || { dot: 'bg-slate-400', bar: 'bg-slate-400', hex: FALLBACK_HEX[index % FALLBACK_HEX.length] };
            const pct = Math.round((count / total) * 100);
            return `
          <div class="flex items-center gap-3">
            <span class="w-2.5 h-2.5 rounded-full ${color.dot} flex-shrink-0"></span>
            <p class="text-sm font-medium text-slate-700 w-20">${jurusan}</p>
            <div class="flex-1 h-1 rounded-full bg-slate-100">
              <div class="h-full ${color.bar} rounded-full" style="width:${pct}%"></div>
            </div>
            <div class="text-right w-20">
              <p class="text-sm font-medium text-slate-800">${count} siswa</p>
              <p class="text-xs text-slate-400">${pct}%</p>
            </div>
          </div>`;
        })
        .join('');

    const avgScore = ((ALL_STUDENTS.reduce((sum, student) => sum + student.recs[0].s, 0) / total) * 100).toFixed(1);
    summaryRow.innerHTML = `
        <div>
          <p class="text-xs text-slate-400">Total siswa</p>
          <p class="text-lg font-medium text-slate-800 mt-0.5">${total} siswa</p>
        </div>
        <div>
          <p class="text-xs text-slate-400">Jurusan unik</p>
          <p class="text-lg font-medium text-slate-800 mt-0.5">${entries.length} jurusan</p>
        </div>
        <div>
          <p class="text-xs text-slate-400">Rata-rata skor</p>
          <p class="text-lg font-medium text-slate-800 mt-0.5">${avgScore}%</p>
        </div>`;
}

const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        filtered = query
            ? ALL_STUDENTS.filter((student) => student.name.toLowerCase().includes(query) || student.id.toLowerCase().includes(query))
            : [...ALL_STUDENTS];
        currentPage = 1;
        renderTable();
    });
}

renderTable();
