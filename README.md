# WICHTIGES UPDATE VOM 26.11.2017

**Achtung** Noch vor dem Erscheinen der Ausgabe des PHP Magazins 2.18 war ein wichtiges
Update in den zu grunde liegenden Libraries erforderlich. Deshalb weicht der Code in 
diesem Repository von dem abgedruckten Code ab! Bisher hatte die `handle()` Methode einer
Intent Klasse immer die beiden Parameter `$smallImageUrl` und `$largeImageUrl` entgegen
genommen:

```
    /**
     * @return AlexaResponse
     */
    public function handle(string $smallImageUrl, string $largeImageUrl): AlexaResponse
    {
        // code
    }
```

Nun steht das `SkillConfiguration` Objekt direkt im Intent bereit und der Zugriff auf
die beiden Parameter erfolgt darüber. Dies sieht nun so aus:

```
    /**
     * @return AlexaResponse
     */
    public function handle(): AlexaResponse
    {
        $smallImageUrl = $this->getSkillConfiguration()->getSmallImageUrl();
        $largeImageUrl = $this->getSkillConfiguration()->getLargeImageUrl();

        // code
    }
```

# PHP Magazin Alexa mit PHP

Beispielprojekt für PHP Magazin über Alexa Skill Entwicklung mit PHP. Die Installation kann 
erfolgen per folgendem Befehl:

```
git clone https://github.com/RalfEggert/phpmagazin.alexa
cd phpmagazin.alexa
composer install
sudo chmod -R 777 data/cache/
```

Richten Sie danach einen Virtual Host `phpmagazin.alexa` für das Verzeichnis 
`/phpmagazin.alexa/html/` ein. 

Um die Funktion der Anwendung nach der Installation zu testen, rufen Sie im Browser die URL
http://phpmagazin.alexa/ auf. Sie sollten eine JSON Ausgabe mit einer Begrüßung erhalten.

Wenn Sie Postman installiert haben, können Sie die Datei `/data/postman/collection.json` 
importieren. Prüfen Sie dann die Abfrage `Zoo LaunchRequest`. Wenn die Rückgabe in etwa so
aussieht wie hier, dann war die Installation erfolgreich:

```
    {
        "version": "1.0",
        "sessionAttributes": [],
        "response": {
            "outputSpeech": {
                "type": "SSML",
                "ssml": "<speak>Willkommen in deinem Zoo</speak>"
            },
            "card": {
                "type": "Standard",
                "title": "Willkommen",
                "text": "Willkommen in deinem Zoo",
                "image": {
                    "smallImageUrl": "https://www.travello.audio/cards/zoo-480x480.png",
                    "largeImageUrl": "https://www.travello.audio/cards/zoo-800x800.png"
                }
            },
            "reprompt": {
                "outputSpeech": {
                    "type": "SSML",
                    "ssml": "<speak>Soll ich noch ein Tier nennen oder willst du abbrechen</speak>"
                }
            },
            "shouldEndSession": false
        }
    }
```
