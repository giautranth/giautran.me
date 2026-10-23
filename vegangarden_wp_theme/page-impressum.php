<?php
/**
 * Template Name: Impressum
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
    margin: 28px 0 12px 0;
    padding-bottom: 8px;
    border-bottom: 2px solid #F6F1E7;
  }
  .legal-card h2:first-of-type {
    margin-top: 0;
  }
  .legal-card h3 {
    font-size: 1.15rem;
    color: var(--primary-green-dark, #203121);
    margin: 20px 0 8px 0;
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
        <a href="<?php echo esc_url(home_url('/')); ?>">Startseite</a> &nbsp;&bull;&nbsp; <span>Impressum</span>
      </div>
      <h1 class="legal-hero-title">Impressum</h1>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <main class="legal-main">
    <div class="container">
      <article class="legal-card">
        
        <h2>Angaben gemäß § 5 DDG</h2>
        <div class="legal-badge-box">
          <p style="margin: 0; font-size: 1.05rem; font-weight: 700; color: #2A160F;">Vegan Garden Berlin</p>
          <p style="margin: 4px 0 0 0; color: #443c35;">
            Frankfurter Allee 21<br>
            10247 Berlin (Friedrichshain)<br>
            Deutschland
          </p>
        </div>

        <h2>Vertreten durch</h2>
        <p>Geschäftsführerin (GFn.): Huong Nguyen</p>

        <h2>Kontakt</h2>
        <p>
          <strong>Telefon:</strong> 030 2123 7260 / 0162 464 9999<br>
          <strong>E-Mail:</strong> <a href="mailto:restaurant@vegan-garden.berlin">restaurant@vegan-garden.berlin</a> / <a href="mailto:info@vegan-garden.berlin">info@vegan-garden.berlin</a><br>
          <strong>Website:</strong> <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(home_url('/')); ?></a>
        </p>

        <h2>Steuernummer</h2>
        <p>
          <strong>Steuernummer:</strong> 14/ 455/ 07509
        </p>

        <h2>Verantwortlich für den Inhalt nach § 18 Abs. 2 MStV</h2>
        <p>
          Huong Nguyen<br>
          Frankfurter Allee 21<br>
          10247 Berlin
        </p>

        <h2>Verbraucherstreitbeilegung / Universalschlichtungsstelle</h2>
        <p>
          Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
        </p>

        <h2>Haftung für Inhalte</h2>
        <p>
          Als Diensteanbieter sind wir gemäß § 7 Abs. 1 DDG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 DDG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
        </p>
        <p>
          Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
        </p>

        <h2>Haftung für Links</h2>
        <p>
          Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar.
        </p>
        <p>
          Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.
        </p>

        <h2>Urheberrecht</h2>
        <p>
          Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet.
        </p>

      </article>
    </div>
  </main>
</div>

<?php
get_footer();
