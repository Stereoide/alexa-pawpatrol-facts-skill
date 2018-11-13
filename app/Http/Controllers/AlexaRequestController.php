<?php

namespace App\Http\Controllers;

use App\Alexa\OutputSpeech;
use App\Alexa\Response;
use Illuminate\Http\Request;

class AlexaRequestController extends Controller
{
    public function request(Request $request)
    {
        $requestBody = $request->getContent();
        $alexaRequest = new \App\Alexa\Request\Request($requestBody, $request->headers);

        if ($alexaRequest->isLaunchRequest() || $alexaRequest->isIntentRequest()) {
            $facts = collect([
                'Chase ist ein Deutscher Schäferhund.',
                'Chase ist der Polizeihund der PAW Patrol.',
                'Chase hat die Nummer zwei.',
                'Chase  liebt es zu spielen´.',
                'Chase muss aufpassen, dass ihn Katzen, Vögel und Blumen nicht zum Niesen bringen.',
                'Chase hat ein dunkelbraunes Fell mit Pfoten, Schwanz, Hals und Gesicht in ocker.',
                'Chase hat ein schwarzes Halsband mit einer Hundemarke.',
                'Auf der Hundemarke von Chase ist ein Polizeistern auf blauem Grund abgebildet.',
                'Chases klassische Uniform besteht aus einer blauen Weste mit Schultermarken.',
                'Auf dem Kopf trägt Chase eine blaue Polizeimütze mit einem schwarzen Schirm.',
                'Seit der zweiten Staffel besitzt Chase eine Geheimagenten-Ausrüstung.',
                'Das Auto von Chase ist dunkelblau und weiß.',
                'Chase besitzt einen Polizeiwagen mit einer lautstarken Sirene, ein helles (abwechselnd rot und blau leuchtendes) Signallicht und einer Seilwinde.',
                'Auf der Ablage von Chases Auto befinden sich Verkehrskegel für die Steuerung des Straßenverkehrs oder um einen Bereich abzugrenzen.',
                'Ist Chase als Pfotenagent unterwegs, beinhaltet sein Fahrzeug auch eine Startvorrichtung für eine Flugdrohne und einen dazugehörigen Überwachungsmonitor und ein Radarsystem.',
                'Ryder ist der Anführer der PAW Patrol.',
                'Ryder ist trägt die Nummer eins.',
                'Ryder ist ein zehn Jahre altes Technikgenie.',
                'Ryder ist das Herrchen seiner Fellfreunde.',
                'Ryder hat braunes hochstehendes Haar und braune Augen.',
                'Ryder trägt ein Sweatshirt und eine Weste, welche bis zur Brust hoch hin rot und darüber weiß mit einem gelben Trennstreifen ist.',
                'Der Kragen, die Schultern und die Taschen von Ryder sind hellblau.',
                'Ryder trägt eine dunkle Jeanshose und Turnschuhe.',
                'Ryder besitzt ein Quad, welches sich sowohl in ein Wasserfahrzeug und ein Schneemobil verwandeln kann.',
                'Ryder trägt beim Quadfahren einen Schutzhelm mit Headset, um mit den Fellfreunden in Kontakt zu bleiben und ihnen Anweisungen zu geben.',
                'Marshall ist ein Dalmatiner.',
                'Marshall ist der Feuerwehr- und Rettungssanitäter-Hund der PAW Patrol.',
                'Marshall hat die Nummer drei.',
                'Marshall ist sehr verspielt und liebenswürdig, aber auch etwas tollpatschig.',
                'Marshall hat ein weißes Fell mit schwarzen Flecken, welche sich über seinen ganzen Körper erstrecken.',
                'Marshall trägt ein gelbes Hundehalsband mit einer Hundemarke.',
                'Auf der Marke von Marshall ist eine Flamme auf rotem Grund abgebildet.',
                'Die Feuerwehruniform von Marshall ist in rot gehalten.',
                'Auf dem Helm von Marshall ist eine kleine Taschenlampe befestigt.',
                'Als Rettungssanitäter besitzt Marshall ein Pup-Pack mit Verbandsmaterial und anderen Erste-Hilfe-Materialien.',
                'Marshalls Feuerwehrauto ist rot.',
                'Marshalls Standardfahrzeug ist ein Feuerwehrauto, welches durch Gebell aktiviert wird. Es beinhaltet eine Feuerwehrleiter und einen Wasserschlauch.',
                'Ist Marshall als Rettungssanitäter unterwegs, dient eine Kabine dem Transport von Verletzten und als Aufbewahrungsort für alle notwendigen Materialien.',
                'Rubble ist eine kleine und liebenswürdige, aber dennoch kräftige Englische Bulldogge.',
                'Rubble ist der Bauarbeiter-Fellfreund der PAW Patrol.',
                'Rubble hat die Nummer sechs.',
                'Mit seinem Werkzeug ist Rubble immer zur Stelle, wenn es etwas zu bauen oder reparieren gibt.',
                'Rubble hat einen kleinen breiten Körper mit einem braunen Fell, wobei seine Pfoten, sein Gesicht und die Schnauze, sowie sein Ohr weiß sind.',
                'Rubble hat ein schwarzes Halsband und eine Hundemarke.',
                'Auf der Hundemarke von Rubble ist ein Schraubenschlüssel mit einer Schraube auf gelbem Gund abgebildet ist.',
                'Als Uniform trägt Rubble eine gelbe Weste mit einem braunen Gürtel.',
                'Auf dem Kopf trät Rubble einen gelben Bauarbeiter-Schutzhelm.',
                'Im Pup-Pack von Rubble befinden sich allerhand Werkzeuge, welche er durch Gebell abrufen und kommandieren kann.',
                'Rubbles Fahrzeug lässt sich in einen Bagger verwandeln und besitzt hinten einen Bohrer und einen Kran.',
                'Rocky ist ein Mischlingswelpe.',
                'Rocky ist der Recyclingspezialist der PAW Patrol.',
                'Rocky hat die Nummer fünf.',
                'Rocky ist der Reparaturkünstler der PAW Patrol.  ',
                'Welchen Rassen Rocky entstammt ist nicht bekannt.',
                'Rocky ist grau mit weißen Pfoten.',
                'Die Spitzen der Fellbüschel an Rockys Wangen und die Spitze seines Schwanzes sind weiß.',
                'Rocky hat einen dunkelgrauen Fleck um sein linkes Auge und zwei am Rücken',
                'Die Augen von Rocky sind braun.',
                'Rockys Halsband ist orange und auf der Hundemarke ist ein Recycling-Symbol auf grünem Grund abgebildet.',
                'Rockys Uniform ist eine grüne Weste mit einem blauen Gürtel.',
                'Auf seinem Kopf trägt Rocky ein grün-weißes Basecap.',
                'Rockys Recyclingtruck ist grün und besitzt zwei orangene Gabeln als Gabelstapler.',
                'Der Kofferraum von Rockys Fahrzeug ist großräumig und es lässt sich nicht erfassen, was dort drinsteckt oder wie viel hineinpasst',
                'Zuma ist ein wassersportverliebter Labradorrüde.',
                'Zuma ist für alle Rettungsaktionen der PAW Patrol im Wasser zuständig.',
                'Zuma hat die Nummer sieben.',
                'Zuma ist ein schokoladenfarbener Labrador Retriever.',
                'Zuma ist das einzige Mitglied mit einem einfarbigen Felö.',
                'Zumas Augen sind braun.',
                'Zuma hat eine orangefarbene Weste mit einem blauen Gürtel.',
                'Zumas Helm ist orange. ',
                'Zuma trägt ein dunkelblaues Halsband mit einer Hundemarke.',
                'Auf Zumas Hundemarke ist ein Anker auf orangefarbenen Grund abgebildet.',
                'Zumas Pup-Pack ist ein Tauchgerät mit einem Propellerantrieb für eine schnelle Fortbewegung unter Wasser.',
                'Nebenbei beinhaltet es eine Lampe und eine Rettungsboje.',
                'Zuma hat ein Luftkissenboot, mit welchem er sich auf dem Land und auf dem Wasser fortbewegen kann.',
                'Vorne an Zumas Luftkissenboot befindet sich eine Auswurfvorrichtung für einen Rettungsring.',
                'Skye ist ein mutiges und furchtloses Cockapoo-Weibchen.',
                'Skye ist bei der PAW Patrol für Luftrettungen und -beobachtungen aller Art zuständig.',
                'Skye hat die Nummer vier.',
                'Skye ist eine Mischung aus Cockerspaniel und Pudel (Cockapoo).',
                'Skye hat ein goldenes flauschiges Fell mt großen, noch flauschigeren Ohren.',
                'Skyes Schnauze und die Pfoten sind hellgelb.',
                'Skye hat ein rosafarbenes Halsband mit einer Hundemarke.',
                'Auf der Hundemarke von Skye ist ein Propeller auf rosanem Grund abgebildet.',
                'Skye trägt eine tiefrosane Weste und auf dem Kopf eine Mütze mit eingebauten Ferngläsern zur Beobachtung.',
                'Das Pup-Pack von Skye ist ein Jetpack, mit welchem sie fliegen kann.',
                'Skye hat einen rosafarbenen Hubschrauber.',
                'Unten an Skyes Hubschrauber befindet sich eine Seilwinde, um Personen und Gegenstände in die Luft zu heben.',
                'Everest ist eine Huskyhündin.',
                'Everest ist die Spezialistin für Berg- und Schneerettungen der PAW Patrol.',
                'Everest hat die Nummer neun.',
                'Everest wurde in die PAW Patrol aufgenommen, nachdem sie Jake bei einem Schneesturm gerettet hat.',
                'Everest hat ein sehr buschiges und überwiegend graues Fell.',
                'Die Pfoten, die Unterseite des Schwanzes, das Gesicht und die Ohren, Hals und Bauch von Everest sind weiß oder weiß-grau.',
                'Everest hat ein schwarzes Halsband mit einer Hundemarke.',
                'Auf der Hundemarke von Everest ist eine schneebedeckte Tanne auf hellblauem Hintergrund abgebildet.',
                'Everest ist ausschließlich mit ihrer Mütze zu Sehen. ',
                'Everest hat lilanes Fell und eine schwarze Nase',
                'Everest trägt eine hellblaue Weste mit einem orangenen Gürtel und orangen Ärmeln.',
                'Everests Pup-Pack ist hellblau und beinhaltet einen Kletterhaken.',
                'Everest bekam von Ryder einen Schneepflug, mit welchem sie schnee- und eisbedeckte Wege freiräumen kann.',
                'Seit der dritten Staffel ist Tracker das neueste Mitglied der PAW Patrol.',
                'Tracker hat die Nummer elf.',
                'Tracker ist ein fröhlicher Chihuahua, welcher im Dschungel bei Carlos lebt und bei Bedarf die PAW Patrol unterstützt.',
                'Auffällig ist, dass Tracker sowohl Deutsch als auch Englisch spricht.',
                'Tracker ist ein Chihuahua und hat ein braunes Fell.',
                'Der Hals, Bauch, Schnauze, Pfoten und das Gesicht von Tracker weiß sind.',
                'Auffallend an Tracker sind die große Ohren, mit welchen er auch entfernte Geräusche sehr gut hört.',
                'Er trägt ein rotes Hundehalsband mit einer Hundemarke.',
                'Auf der Hundemarke von Tracker ist ein Kompass auf olivfarbenen Grund abgebildet ist.',
                'Tracker trägt eine olivfarbene Weste und einen ebenso olivfarbenen Hut mit Auslassungen für seine Ohren.',
                'Eine wichtige Funktion in Trackers Pup-Pack haben die Kletterseile, mit welchen er sich im Dschungel von Ast zu Ast schwingen kann und welche auch als Seilwinde verwendet werden können.',
                'Tracker fährt ein Geländefahrzeug mit weiß-grünem Camouflage-Lackierung.',
                'Auf dem Dach von Trackers Geländefahrzeug befinden sich vier zusätzliche Scheinwerfer',
            ]);

            $response = new Response();
            return $response->withOutputSpeech(new OutputSpeech($facts->random()))->render();
        }
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    public function termsOfUse()
    {
        return view('terms-of-use');
    }
}
