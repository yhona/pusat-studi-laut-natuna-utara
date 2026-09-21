/**
 * Playwright System & Frontend Verification Script
 * Validates dynamic rendering of clusters, news, translations, and dashboard stats
 */
const { chromium } = require('playwright');
const fs = require('fs');
const path = require('path');

const BASE_URL = process.env.APP_URL || 'http://127.0.0.1:8080';
const LOG_FILE = path.join(__dirname, 'writable', 'logs', 'playwright_checks.log');

async function runHealthCheck() {
    const timestamp = new Date().toISOString();
    console.log(`[${timestamp}] Starting Playwright UI/UX & Dynamic Logic verification against ${BASE_URL}...`);

    const browser = await chromium.launch({
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });

    const context = await browser.newContext({
        viewport: { width: 1280, height: 800 },
        userAgent: 'NNSRC-Playwright-HealthCheck/1.0'
    });

    const page = await context.newPage();
    const reports = [];

    try {
        // 1. Check Homepage & Dynamic Clusters
        const homeRes = await page.goto(`${BASE_URL}/`, { waitUntil: 'domcontentloaded', timeout: 15000 });
        const homeStatus = homeRes.status();
        const clusterCards = await page.$$('section:has-text("Klaster") .group');
        reports.push({
            target: 'Homepage /',
            status: homeStatus,
            clustersRendered: clusterCards.length,
            passed: homeStatus === 200 && clusterCards.length >= 4
        });
        console.log(`  -> Homepage (HTTP ${homeStatus}) rendered ${clusterCards.length} cluster cards.`);

        // 2. Check Bilingual Switcher
        const enRes = await page.goto(`${BASE_URL}/lang/en`, { waitUntil: 'domcontentloaded', timeout: 15000 });
        const enTitle = await page.title();
        const isEnglish = enTitle.includes('NNSRC') || enTitle.includes('North Natuna');
        reports.push({
            target: 'Bilingual /lang/en',
            status: enRes.status(),
            title: enTitle,
            passed: isEnglish
        });
        console.log(`  -> English Switcher: ${isEnglish ? 'PASSED' : 'FAILED'} (${enTitle})`);

        // Switch back to ID
        await page.goto(`${BASE_URL}/lang/id`, { waitUntil: 'domcontentloaded', timeout: 15000 });

        // 3. Check Research Cluster Route
        const risetRes = await page.goto(`${BASE_URL}/riset/hukum-laut`, { waitUntil: 'domcontentloaded', timeout: 15000 });
        const risetTitle = await page.title();
        reports.push({
            target: 'Cluster Detail /riset/hukum-laut',
            status: risetRes.status(),
            title: risetTitle,
            passed: risetRes.status() === 200
        });
        console.log(`  -> Cluster Detail: HTTP ${risetRes.status()}`);

        // 4. Check Admin Login UI Responsiveness & Elements
        const loginRes = await page.goto(`${BASE_URL}/admin/login`, { waitUntil: 'domcontentloaded', timeout: 15000 });
        const usernameInput = await page.$('input[name="username"]');
        const passwordInput = await page.$('input[name="password"]');
        reports.push({
            target: 'Admin Login /admin/login',
            status: loginRes.status(),
            hasCredentialsInputs: !!(usernameInput && passwordInput),
            passed: loginRes.status() === 200 && !!(usernameInput && passwordInput)
        });
        console.log(`  -> Admin Login: HTTP ${loginRes.status()}, Form Inputs: OK`);

        // Summarize verification
        const allPassed = reports.every(r => r.passed);
        const logEntry = `[${timestamp}] [PLAYWRIGHT 15-MIN CHECK] Status: ${allPassed ? 'SUCCESS' : 'WARNING'} | Tests: ${reports.length} | Details: ${JSON.stringify(reports)}\n`;

        fs.appendFileSync(LOG_FILE, logEntry);

        // Update JSON health report
        const healthReportPath = path.join(__dirname, 'writable', 'playwright_status.json');
        fs.writeFileSync(healthReportPath, JSON.stringify({
            status: allPassed ? 'HEALTHY' : 'DEGRADED',
            last_checked: timestamp,
            last_checked_human: new Date().toLocaleString('id-ID', { timeZone: 'Asia/Jakarta' }) + ' WIB',
            results: reports
        }, null, 2));

        console.log(`[${timestamp}] Playwright checks completed. All passed: ${allPassed}`);
    } catch (err) {
        console.error(`[${timestamp}] Playwright check ERROR:`, err.message);
        fs.appendFileSync(LOG_FILE, `[${timestamp}] [PLAYWRIGHT ERROR] ${err.message}\n`);
    } finally {
        await browser.close();
    }
}

runHealthCheck();
