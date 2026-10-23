<?php
/**
 * Template Name: Datenschutzerklärung
 */
get_header();
?>

<style>
  .legal-page-wrap {
    background-color: #F6F1E7;
    color: #211A16;
  }
  .legal-hero {
    background: linear-gradient(135deg, #2A160F 0%, #3d2319 100%);
    color: #ffffff;
    padding: 50px 0 40px;
    text-align: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }
  .legal-breadcrumbs {
    font-size: 0.88rem;
    color: rgba(255, 255, 255, 0.7);
    margin-bottom: 14px;
  }
  .legal-breadcrumbs a {
    color: rgba(255, 255, 255, 0.85);
    text-decoration: none;
    transition: color 0.2s ease;
  }
  .legal-breadcrumbs a:hover {
    color: #34A853;
  }
  .legal-hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.6rem;
    color: #ffffff;
    letter-spacing: 0.04em;
    margin: 0;
  }
  .legal-main {
    padding: 50px 0 70px;
    background-color: #F6F1E7;
  }
  .legal-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 44px 40px;
    box-shadow: 0 4px 24px rgba(42, 22, 15, 0.06);
    max-width: 900px;
    margin: 0 auto;
    line-height: 1.7;
  }
  .legal-card h2 {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    color: #2A160F;
    margin: 32px 0 14px 0;
    padding-bottom: 8px;
    border-bottom: 2px solid #F6F1E7;
  }
  .legal-card h2:first-of-type {
    margin-top: 0;
  }
  .legal-card h3 {
    font-size: 1.15rem;
    color: var(--primary-green-dark, #203121);
    margin: 22px 0 10px 0;
  }
  .legal-card p, .legal-card ul {
    color: #443c35;
    font-size: 0.95rem;
    margin-bottom: 16px;
    text-align: justify !important;
    text-justify: inter-word !important;
    hyphens: auto;
    -webkit-hyphens: auto;
    -ms-hyphens: auto;
  }
  .legal-card ul {
    padding-left: 20px;
  }
  .legal-card li {
    margin-bottom: 8px;
    text-align: justify !important;
    text-justify: inter-word !important;
    hyphens: auto;
    -webkit-hyphens: auto;
    -ms-hyphens: auto;
  }
  .legal-card a {
    color: #2e7d32;
    text-decoration: underline;
  }
  .legal-badge-box {
    background: #FAF7F2;
    border-left: 4px solid #34A853;
    padding: 16px 20px;
    border-radius: 8px;
    margin: 20px 0;
  }
  @media (max-width: 768px) {
    .legal-card {
      padding: 28px 20px;
      border-radius: 12px;
    }
    .legal-hero-title {
      font-size: 2rem;
    }
  }
</style>

<div class="legal-page-wrap">
  <!-- HERO SECTION -->
  <section class="legal-hero">
    <div class="container">
      <div class="legal-breadcrumbs">
        <a href="<?php echo esc_url(home_url('/')); ?>">Startseite</a> &nbsp;&bull;&nbsp; <span>Datenschutzerklärung</span>
      </div>
      <h1 class="legal-hero-title">Datenschutzerklärung</h1>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <main class="legal-main">
    <div class="container">
      <article class="legal-card">

        <h2>1. Datenschutz auf einen Blick</h2>
        <h3>Allgemeine Hinweise</h3>
        <p>
          Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen Daten passiert, wenn Sie unsere Website besuchen. Personenbezogene Daten sind alle Daten, mit denen Sie persönlich identifiziert werden können.
        </p>

        <h3>Datenerfassung auf unserer Website</h3>
        <p>
          <strong>Wer ist verantwortlich für die Datenerfassung auf dieser Website?</strong><br>
          Die Datenverarbeitung auf dieser Website erfolgt durch den Websitebetreiber:
        </p>
        <div class="legal-badge-box">
          <p style="margin: 0; font-weight: 700; color: #2A160F;">Vegan Garden Berlin</p>
          <p style="margin: 4px 0 0 0; color: #443c35;">
            Geschäftsführerin (GFn.): Huong Nguyen<br>
            Frankfurter Allee 21, 10247 Berlin (Friedrichshain)<br>
            Telefon: 030 2123 7260 / 0162 464 9999<br>
            E-Mail: <a href="mailto:info@vegan-garden.berlin">info@vegan-garden.berlin</a>
          </p>
        </div>

        <h2>2. Allgemeine Hinweise und Pflichtinformationen</h2>
        <h3>Datenschutz</h3>
        <p>
          Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln Ihre personenbezogenen Daten vertraulich und entsprechend den gesetzlichen Datenschutzvorschriften (DSGVO, BDSG) sowie dieser Datenschutzerklärung.
        </p>

        <h3>Hinweis zur verantwortlichen Stelle</h3>
        <p>
          Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:<br>
          <strong>Restaurant Vegan Garden Berlin</strong><br>
          Geschäftsführerin: Huong Nguyen<br>
          Frankfurter Allee 21<br>
          10247 Berlin, Deutschland<br>
          Telefon: 030 2123 7260<br>
          E-Mail: <a href="mailto:info@vegan-garden.berlin">info@vegan-garden.berlin</a>
        </p>

        <h3>Ihre Rechte als betroffene Person</h3>
        <p>Sie haben im Rahmen der geltenden gesetzlichen Bestimmungen jederzeit das Recht auf:</p>
        <ul>
          <li><strong>Auskunft (Art. 15 DSGVO):</strong> Kostenlose Auskunft über Ihre gespeicherten personenbezogenen Daten, deren Herkunft, Empfänger und den Zweck der Datenverarbeitung.</li>
          <li><strong>Berichtigung (Art. 16 DSGVO):</strong> Berichtigung unrichtiger oder Vervollständigung unvollständiger Daten.</li>
          <li><strong>Löschung (Art. 17 DSGVO):</strong> Löschung Ihrer bei uns gespeicherten Daten, sofern keine gesetzlichen Aufbewahrungspflichten entgegenstehen.</li>
          <li><strong>Einschränkung der Verarbeitung (Art. 18 DSGVO):</strong> Einschränkung der Datenverarbeitung unter bestimmten Voraussetzungen.</li>
          <li><strong>Datenübertragbarkeit (Art. 20 DSGVO):</strong> Aushändigung Ihrer Daten in einem gängigen, maschinenlesbaren Format.</li>
          <li><strong>Widerruf Ihrer Einwilligung (Art. 7 Abs. 3 DSGVO):</strong> Sie können eine bereits erteilte Einwilligung zur Datenverarbeitung jederzeit mit Wirkung für die Zukunft widerrufen.</li>
          <li><strong>Beschwerderecht bei der Aufsichtsbehörde (Art. 77 DSGVO):</strong> Im Falle von Verstößen steht Ihnen ein Beschwerderecht bei der zuständigen Aufsichtsbehörde (z. B. Berliner Beauftragte für Datenschutz und Informationsfreiheit) zu.</li>
        </ul>

        <h2>3. Datenerfassung auf unserer Website</h2>

        <h3>Cookies</h3>
        <p>
          Unsere Website verwendet so genannte „Cookies“. Cookies sind kleine Textdateien, die auf Ihrem Endgerät abgelegt werden und die Ihr Browser speichert. Sie richten keinen Schaden an. Wir setzen technisch notwendige Cookies ein (z. B. zur Speicherung Ihrer Sprachpräferenz <code>vg_lang</code>). Weitere Informationen hierzu finden Sie in unseren <a href="<?php echo esc_url(home_url('/cookie-einstellungen/')); ?>">Cookie-Einstellungen</a>.
        </p>

        <h3>Server-Log-Dateien</h3>
        <p>
          Der Provider der Seiten erhebt und speichert automatisch Informationen in so genannten Server-Log-Dateien, die Ihr Browser automatisch an uns übermittelt. Dies sind:
        </p>
        <ul>
          <li>Browsertyp und Browserversion</li>
          <li>Verwendetes Betriebssystem</li>
          <li>Referrer URL (die zuvor besuchte Seite)</li>
          <li>Hostname des zugreifenden Rechners</li>
          <li>Uhrzeit der Serveranfrage</li>
          <li>IP-Adresse (in der Regel anonymisiert)</li>
        </ul>
        <p>Eine Zusammenführung dieser Daten mit anderen Datenquellen wird nicht vorgenommen.</p>

        <h3>Kontaktformular &amp; E-Mail-Kontakt</h3>
        <p>
          Wenn Sie uns per Kontaktformular oder E-Mail Anfragen zukommen lassen, werden Ihre Angaben aus dem Anfrageformular inklusive der von Ihnen dort angegebenen Kontaktdaten zwecks Bearbeitung der Anfrage und für den Fall von Anschlussfragen bei uns gespeichert. Diese Daten geben wir nicht ohne Ihre Einwilligung weiter.
        </p>

        <h3>Online-Tischreservierung</h3>
        <p>
          Wenn Sie über unsere Website eine Tischreservierung vornehmen, erfassen wir die von Ihnen eingegebenen Daten (Name, E-Mail-Adresse, Telefonnummer, Datum, Uhrzeit, Personenanzahl und eventuelle Anmerkungen). Die Verarbeitung erfolgt auf Grundlage von Art. 6 Abs. 1 lit. b DSGVO zur Erfüllung des Bewirtungsvertrags bzw. zur Durchführung vorvertraglicher Maßnahmen. Die Daten werden vertraulich auf unserem eigenen Server verarbeitet und zur Reservierungsbestätigung direkt an unser Restaurant-Team (<code>restaurant@vegan-garden.berlin</code>) gesendet. Eine Weitergabe an externe Vermittlungs- oder Reservierungsplattformen findet nicht statt.
        </p>

        <h2>4. Externe Dienste und Drittanbieter</h2>
        
        <h3>Google Web Fonts</h3>
        <p>
          Diese Seite nutzt zur einheitlichen Darstellung von Schriftarten so genannte Web Fonts (Playfair Display und Plus Jakarta Sans), die von Google bereitgestellt werden. Beim Aufruf einer Seite lädt Ihr Browser die benötigten Web Fonts in ihren Browsercache.
        </p>

        <h3>Google Maps (Zwei-Klick-Lösung)</h3>
        <p>
          Diese Seite nutzt über eine API den Kartendienst Google Maps. Anbieter ist die Google Ireland Limited („Google“), Gordon House, Barrow Street, Dublin 4, Irland. Zum Schutz Ihrer Privatsphäre setzen wir eine <strong>Zwei-Klick-Lösung</strong> ein: Die interaktive Karte wird erst dann geladen, wenn Sie diese aktiv mit einem Klick („Karte laden“ oder „Karte aktivieren“) einschalten oder zuvor allen funktionalen Cookies zugestimmt haben. Erst mit Ihrer ausdrücklichen Einwilligung (Art. 6 Abs. 1 lit. a DSGVO) wird eine Verbindung zu den Servern von Google aufgebaut und Ihre IP-Adresse an Google übermittelt. Mehr Informationen finden Sie in der <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Datenschutzerklärung von Google</a>.
        </p>

        <h2>5. SSL- bzw. TLS-Verschlüsselung</h2>
        <p>
          Diese Seite nutzt aus Sicherheitsgründen und zum Schutz der Übertragung vertraulicher Inhalte, wie zum Beispiel Bestellungen oder Anfragen, eine SSL- bzw. TLS-Verschlüsselung. Eine verschlüsselte Verbindung erkennen Sie daran, dass die Adresszeile des Browsers von „http://“ auf „https://“ wechselt und an dem Schloss-Symbol in Ihrer Browserzeile.
        </p>

      </article>
    </div>
  </main>
</div>

<?php
get_footer();
