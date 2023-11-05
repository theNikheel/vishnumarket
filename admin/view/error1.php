<body xmlns="http://www.w3.org/1999/xhtml" class="neterror">
    <!-- PAGE CONTAINER (for styling purposes only) -->
    <div class="container">
      <div id="text-container">
        <!-- Error Title -->
        <div class="title">
          <h1 class="title-text" data-l10n-id="netTimeout-title">The connection has timed out</h1>
        </div>

        <!-- Short Description -->
        <p id="errorShortDesc" data-l10n-id="cert-error-ssl-connection-error" data-l10n-args="{&quot;errorMessage&quot;:&quot;&quot;,&quot;hostname&quot;:&quot;bom1plzcpnl493869.prod.bom1.secureserver.net:2083&quot;}">An error occurred during a connection to bom1plzcpnl493869.prod.bom1.secureserver.net:2083. </p>
        <p id="errorShortDesc2"></p>

        <div id="errorWhatToDo" hidden="">
          <p id="errorWhatToDoTitle" data-l10n-id="certerror-what-can-you-do-about-it-title">What can you do about it?</p>
          <p id="badStsCertExplanation" hidden=""></p>
          <p id="errorWhatToDoText"></p>
        </div>

        <!-- Long Description -->
        <div id="errorLongDesc"><ul><li data-l10n-id="neterror-load-error-try-again">The site could be temporarily unavailable or too busy. Try again in a few moments.</li><li data-l10n-id="neterror-load-error-connection">If you are unable to load any pages, check your computer’s network connection.</li><li data-l10n-id="neterror-load-error-firewall">If your computer or network is protected by a firewall or proxy, make sure that Firefox is permitted to access the web.</li></ul></div>

        <p id="tlsVersionNotice" hidden=""></p>

        <p id="learnMoreContainer" hidden="">
          <a id="learnMoreLink" target="_blank" rel="noopener noreferrer" data-telemetry-id="learn_more_link" data-l10n-id="neterror-learn-more-link" href="https://support.mozilla.org/1/firefox/108.0/Linux/en-US/connection-not-secure">Learn more…</a>
        </p>


        <!-- UI for option to report certificate errors to Mozilla. Removed on
             init for other error types .-->
        <div id="prefChangeContainer" class="button-container" hidden="">
          <p data-l10n-id="neterror-pref-reset">It looks like your network security settings might be causing this. Do you want the default settings to be restored?</p>
          
        </div>

        <div id="certErrorAndCaptivePortalButtonContainer" class="button-container" hidden="">
          <button id="openPortalLoginPageButton" class="primary" data-l10n-id="neterror-open-portal-login-page-button" hidden="">Open Network Login Page</button>
          <button id="certErrorTryAgainButton" class="primary try-again" data-l10n-id="neterror-try-again-button" hidden="">Try Again</button>
          
        </div>
      </div>

      <div id="netErrorButtonContainer" class="button-container"><button class="primary try-again" data-l10n-id="neterror-try-again-button">Try Again</button>
        
      </div>

      <div class="advanced-panel-container">
        <div id="badCertAdvancedPanel" class="advanced-panel" hidden="">
          <p id="badCertTechnicalInfo"></p>
          <a id="viewCertificate" href="javascript:void(0)" data-l10n-id="neterror-view-certificate-link">View Certificate</a>
          <div id="advancedPanelButtonContainer" class="button-container">
            <button id="advancedPanelReturnButton" class="primary" data-telemetry-id="return_button_adv" data-l10n-id="neterror-return-to-previous-page-recommended-button">Go Back (Recommended)</button>
            <button id="advancedPanelTryAgainButton" class="primary try-again" data-l10n-id="neterror-try-again-button" hidden="">Try Again</button>
            <button id="exceptionDialogButton" data-telemetry-id="exception_button" data-l10n-id="neterror-override-exception-button">Accept the Risk and Continue</button>
          </div>
        </div>

        <div id="blockingErrorReporting" class="advanced-panel" hidden="">
          <p class="toggle-container-with-text">
            <input type="checkbox" id="automaticallyReportBlockingInFuture" role="checkbox" />
            <label for="automaticallyReportBlockingInFuture" data-l10n-id="neterror-error-reporting-automatic">Report errors like this to help Mozilla identify and block malicious sites</label>
          </p>
        </div>

        <div id="certificateErrorDebugInformation" class="advanced-panel" hidden="">
          <button id="copyToClipboardTop" data-telemetry-id="clipboard_button_top" data-l10n-id="neterror-copy-to-clipboard-button">Copy text to clipboard</button>
          <div id="certificateErrorText"></div>
          <button id="copyToClipboardBottom" data-telemetry-id="clipboard_button_bot" data-l10n-id="neterror-copy-to-clipboard-button">Copy text to clipboard</button>
        </div>
      </div>
    </div>
  </body>
  
<style>
header,nav{
    display:none !important;
}
button.primary.try-again {
    background-color: #0061e0;
    color: white;
    border: 0px;
    padding: 10px 25px;
    font-weight: bold;
    border-color: #0061e0;
    border-radius: 7px;
}

.button-container {
  display: flex;
  flex-flow: row wrap;
  justify-content: end;
}

body {
  background-size: 64px 32px;
  background-repeat: repeat-x;
  padding: 0;
    padding-top: 0px;
    padding-bottom: 0px;
  min-width: 13em;
}
body {
  display: flex;
  flex-direction: column;
  box-sizing: border-box;
  min-height: 100vh;
  padding: 40px 48px;
  align-items: center;
  justify-content: center;
}
</style>