��    �      \  �   �      p  D   q  ?   �  I   �      @     a  &   s     �     �  -   �            =   0     n     �  �   �     8  a   X  K   �       A   !  !   c  3   �  ?   �  H   �  D   B  C   �  E   �  ?     ?   Q  >   �  9   �  B   
  E   M  �   �  0     F   I  >   �  8   �  I     %   R  2   x  O   �  7   �     3     :     C  M   U  -   �  !   �  >   �  E   2  C   x  y   �  9   6  D   p  C   �  D   �  >   >  A   }  ,   �  2   �  6     >   V  *   �  /   �  %   �  1     0   H  #   y     �  4   �  2   �  1   #  0   U  ,   �  .   �  3   �  -     1   D  6   v  :   �  1   �  *     "   E  $   h  J   �     �     �  3     0   ?     p     �  !   �  $   �      �  -   
  4   8  %   m  $   �  "   �  !   �  F   �  u   D   F   �      !  7   !  )   M!  k   w!  `   �!  %   D"  &   j"     �"  d   �"     �"  &   #  0   D#  .   u#  )   �#  )   �#  "   �#      $  (   <$     e$  !   �$     �$     �$     �$     �$     �$     %     %     -%     =%  "   U%     x%  �  �%  G   `'  =   �'  R   �'      9(     Z(  ,   u(  &   �(  +   �(  5   �(     +)     D)  D   ^)      �)  !   �)  r   �)  !   Y*  j   {*  P   �*     7+  E   T+  !   �+  @   �+  >   �+  L   <,  C   �,  L   �,  H   -  B   c-  9   �-  C   �-  ;   $.  R   `.  E   �.  �   �.  B   �/  K   �/  N   0  7   m0  M   �0  ,   �0  C    1  �   d1  <   �1     &2  	   /2     92  `   O2  )   �2     �2  B   �2  M   =3  :   �3  �   �3  D   }4  T   �4  O   5  O   g5  B   �5  L   �5  +   G6  I   s6  8   �6  :   �6  .   17  /   `7  (   �7  5   �7  4   �7  &   $8     K8  8   i8  I   �8  A   �8  3   .9  6   b9  -   �9  6   �9  6   �9  6   5:  8   l:  6   �:  L   �:  #   );  &   M;  +   t;  W   �;  !   �;     <  7   9<  <   q<     �<     �<     �<  '    =  %   (=  2   N=  G   �=      �=  (   �=  #   >  #   7>  T   [>  p   �>  K   !?     m?  :   ~?  )   �?  |   �?  i   `@  7   �@  )   A     ,A  m   8A     �A  )   �A  *   �A  #   B  !   =B  !   _B     �B  %   �B  &   �B  "   �B  "   C     4C     SC      kC     �C     �C     �C     �C     �C     �C  !   	D     +D     m   g       L       I       s      "   ?   �   C   7   ^      {          J   H   �   `   t       v   )       �   &      q   R   1   n   K           +      3   p           �   r   x   |   ;   F   6   V      U       ~   <   4       E   '          D                        
              �       (   =          z   f   A   c   k       �      b           /   �             Q   P   	          a   ,   u   !      5              h       *      >       M   \   S       e   @       B   �   W   %   8      Z       w   .   $          G   l   T   #   N   _   j             -      [   ]      X       :       2       y   9   �         Y   }      O           o                  0   i   d                    
%s: -w option cannot use a relative socket directory specification
 
%s: -w option is not supported when starting a pre-9.1 server
 
%s: this data directory appears to be running a pre-existing postmaster
 
Allowed signal names for kill:
 
Common options:
 
Options for register and unregister:
 
Options for start or restart:
 
Options for stop or restart:
 
Report bugs to <pgsql-bugs@postgresql.org>.
 
Shutdown modes are:
 
Start types are:
   %s init[db]               [-D DATADIR] [-s] [-o "OPTIONS"]
   %s kill    SIGNALNAME PID
   %s promote [-D DATADIR] [-s]
   %s register   [-N SERVICENAME] [-U USERNAME] [-P PASSWORD] [-D DATADIR]
                    [-S START-TYPE] [-w] [-t SECS] [-o "OPTIONS"]
   %s reload  [-D DATADIR] [-s]
   %s restart [-w] [-t SECS] [-D DATADIR] [-s] [-m SHUTDOWN-MODE]
                 [-o "OPTIONS"]
   %s start   [-w] [-t SECS] [-D DATADIR] [-s] [-l FILENAME] [-o "OPTIONS"]
   %s status  [-D DATADIR]
   %s stop    [-W] [-t SECS] [-D DATADIR] [-s] [-m SHUTDOWN-MODE]
   %s unregister [-N SERVICENAME]
   -?, --help             show this help, then exit
   -D, --pgdata=DATADIR   location of the database storage area
   -N SERVICENAME  service name with which to register PostgreSQL server
   -P PASSWORD     password of account to register PostgreSQL server
   -S START-TYPE   service start type to register PostgreSQL server
   -U USERNAME     user name of account to register PostgreSQL server
   -V, --version          output version information, then exit
   -W                     do not wait until operation completes
   -c, --core-files       allow postgres to produce core files
   -c, --core-files       not applicable on this platform
   -l, --log=FILENAME     write (or append) server log to FILENAME
   -m, --mode=MODE        MODE can be "smart", "fast", or "immediate"
   -o OPTIONS             command line options to pass to postgres
                         (PostgreSQL server executable) or initdb
   -p PATH-TO-POSTGRES    normally not necessary
   -s, --silent           only print errors, no informational messages
   -t, --timeout=SECS     seconds to wait when using -w option
   -w                     wait until operation completes
   auto       start service automatically during system startup (default)
   demand     start service on demand
   fast        quit directly, with proper shutdown
   immediate   quit without complete shutdown; will lead to recovery on restart
   smart       quit after all clients have disconnected
  done
  failed
  stopped waiting
 %s is a utility to initialize, start, stop, or control a PostgreSQL server.

 %s: -S option not supported on this platform
 %s: PID file "%s" does not exist
 %s: WARNING: cannot create restricted tokens on this platform
 %s: WARNING: could not locate all job object functions in system API
 %s: another server might be running; trying to start server anyway
 %s: cannot be run as root
Please log in (using, e.g., "su") as the (unprivileged) user that will
own the server process.
 %s: cannot promote server; server is not in standby mode
 %s: cannot promote server; single-user server is running (PID: %ld)
 %s: cannot reload server; single-user server is running (PID: %ld)
 %s: cannot restart server; single-user server is running (PID: %ld)
 %s: cannot set core file size limit; disallowed by hard limit
 %s: cannot stop server; single-user server is running (PID: %ld)
 %s: could not allocate SIDs: error code %lu
 %s: could not create promote signal file "%s": %s
 %s: could not create restricted token: error code %lu
 %s: could not determine the data directory using command "%s"
 %s: could not find own program executable
 %s: could not find postgres program executable
 %s: could not open PID file "%s": %s
 %s: could not open process token: error code %lu
 %s: could not open service "%s": error code %lu
 %s: could not open service manager
 %s: could not read file "%s"
 %s: could not register service "%s": error code %lu
 %s: could not remove promote signal file "%s": %s
 %s: could not send promote signal (PID: %ld): %s
 %s: could not send reload signal (PID: %ld): %s
 %s: could not send signal %d (PID: %ld): %s
 %s: could not send stop signal (PID: %ld): %s
 %s: could not start server
Examine the log output.
 %s: could not start server: exit code was %d
 %s: could not start service "%s": error code %lu
 %s: could not unregister service "%s": error code %lu
 %s: could not wait for server because of misconfiguration
 %s: could not write promote signal file "%s": %s
 %s: database system initialization failed
 %s: invalid data in PID file "%s"
 %s: missing arguments for kill mode
 %s: no database directory specified and environment variable PGDATA unset
 %s: no operation specified
 %s: no server running
 %s: old server process (PID: %ld) seems to be gone
 %s: option file "%s" must have exactly one line
 %s: out of memory
 %s: server does not shut down
 %s: server is running (PID: %ld)
 %s: service "%s" already registered
 %s: service "%s" not registered
 %s: single-user server is running (PID: %ld)
 %s: too many command-line arguments (first is "%s")
 %s: unrecognized operation mode "%s"
 %s: unrecognized shutdown mode "%s"
 %s: unrecognized signal name "%s"
 %s: unrecognized start type "%s"
 (The default is to wait for shutdown, but not for start or restart.)

 HINT: The "-m fast" option immediately disconnects sessions rather than
waiting for session-initiated disconnection.
 If the -D option is omitted, the environment variable PGDATA is used.
 Is server running?
 Please terminate the single-user server and try again.
 Server started and accepting connections
 The program "%s" is needed by %s but was not found in the
same directory as "%s".
Check your installation.
 The program "%s" was found by "%s"
but was not the same version as %s.
Check your installation.
 Timed out waiting for server startup
 Try "%s --help" for more information.
 Usage:
 WARNING: online backup mode is active
Shutdown will not complete until pg_stop_backup() is called.

 Waiting for server startup...
 child process exited with exit code %d child process exited with unrecognized status %d child process was terminated by exception 0x%X child process was terminated by signal %d child process was terminated by signal %s could not change directory to "%s" could not find a "%s" to execute could not identify current directory: %s could not read binary "%s" could not read symbolic link "%s" invalid binary "%s" server is still starting up
 server promoting
 server shutting down
 server signaled
 server started
 server starting
 server stopped
 starting server anyway
 waiting for server to shut down... waiting for server to start... Project-Id-Version: pg_ctl-cs (PostgreSQL 9.2)
Report-Msgid-Bugs-To: pgsql-bugs@postgresql.org
POT-Creation-Date: 2012-09-18 16:46+0000
PO-Revision-Date: 2012-09-19 01:35+0200
Last-Translator: Tomas Vondra <tv@fuzzy.cz>
Language-Team: Czech <info@cspug.cx>
Language: cs
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Plural-Forms: nplurals=3; plural=(n==1) ? 0 : (n>=2 && n<=4) ? 1 : 2;
X-Generator: Lokalize 1.4
 
%s: -w volba nemůže používat relativně zadaný adresář socketu
 
%s: -w volba není podporována při startu pre-9.1 serveru
 
%s: zdá se že v tomto datovém adresáři již běží existující postmaster
 
Povolené signály pro "kill":
 
Společné přepínače:
 
Přepínače pro register nebo unregister:
 
Přepínače pro start nebo restart:
 
Přepínače pro zastavení nebo restart:
 
Chyby hlaste na adresu <pgsql-bugs@postgresql.org>.
 
Módy ukončení jsou:
 
Módy spuštění jsou:
   %s init[db]               [-D ADRESÁŘ] [-s] [-o "PŘEPÍNAČE"]
   %s kill    SIGNÁL  IDPROCESU
   %s promote [-D ADRESÁŘ] [-s]
   %s register   [-N NÁZEVSLUŽBY] [-U UŽIVATEL] [-P HESLO] [-D ADRESÁŘ]
                    [-w] [-o "VOLBY"]
   %s reload  [-D ADRESÁŘ] [-s]
   %s restart [-w] [-t SECS] [-D ADRESÁŘ] [-s] [-m MÓD-UKONČENÍ]
                 [-o "PŘEPÍNAČE"]
   %s start   [-w] [-t SECS] [-D ADRESÁŘ] [-s] [-l SOUBOR] [-o "PŘEPÍNAČE"]
   %s status  [-D ADRESÁŘ]
   %s stop    [-W] [-t SECS] [-D ADRESÁŘ] [-s] [-m MÓD-UKONČENÍ]
   %s unregister [-N SERVICENAME]
   -?, --help             vypsat tuto nápovědu, potom skončit
   -D, --pgdata=ADRESÁŘ   umístění úložiště databáze
   -N SERVICENAME  jméno služby, pod kterým registrovat PostgreSQL server
   -P PASSWORD     heslo k účtu pro registraci PostgreSQL serveru
   -S TYP-STARTU   typ spuštění služby pro registraci PostgreSQL serveru
   -U USERNAME     uživatelské jméno pro registraci PostgreSQL server
   -V, --version          vypsat informace o verzi, potom skončit
   -W                     nečekat na dokončení operace
   -c, --core-files       povolit postgresu vytvářet core soubory
   -c, --core-files       nepoužitelné pro tuto platformu
   -l, --log=SOUBOR        zapisuj (nebo připoj na konec) log serveru do SOUBORU.
   -m, --mode=MODE        může být "smart", "fast", or "immediate"
   -o PŘEPÍNAČE            přepínače, které budou předány postgresu
                          (spustitelnému souboru PostgreSQL) či initdb
   -p CESTA-K-POSTGRESU  za normálních okolností není potřeba
   -s, --silent           vypisuj jen chyby, žádné informativní zprávy
   -t, --timeout=SECS     počet vteřin pro čekání při využití volby -w
   -w                     čekat na dokončení operace
   auto       spusť službu automaticky během startu systému (implicitní)
   demand     spusť službu na vyžádání
   fast        skonči okamžitě, s korektním zastavením serveru
   immediate   skonči bez kompletního zastavení; další start provede                           obnovu po pádu (crash recovery)
   smart       skonči potom, co se odpojí všichni klienti
  hotovo
  selhalo
  přestávám čekat
 %s je nástroj pro inicializaci, spuštění, zastavení, nebo ovládání PostgreSQL serveru.

 %s: -S nepoužitelné pro tuto platformu
 %s: PID soubor "%s" neexistuje
 %s: VAROVÁNÍ: na této platformě nelze vytvořit tajné tokeny
 %s: VAROVÁNÍ: v systémovém API nelze najít všechny "job object" funkce
 %s: další server možná běží; i tak zkouším start
 %s: nemůže běžet pod uživatelem root
Prosím přihlaste se jako (neprivilegovaný) uživatel, který bude vlastníkem
serverového procesu (například pomocí příkazu "su").
 %s: nelze povýšit (promote) server; server není ve standby módu
 %s: nelze povýšit (promote) server; server běží v single-user módu (PID: %ld)
 %s: nemohu znovunačíst server; server běží v single-user módu (PID: %ld)
 %s: nemohu restartovat server; postgres běží v single-user módu (PID: %ld)
 %s: nelze nastavit limit pro core soubor; zakázáno hard limitem
 %s: nemohu zastavit server; postgres běží v single-user módu (PID: %ld)
 %s: nelze alokovat SIDs: chybový kód %lu
 %s: nelze vytvořit signální soubor pro povýšení (promote) "%s": %s
 %s: nelze vytvořit vyhrazený token: chybový kód %lu
 %s: nelze najít datový adresář pomocí příkazu "%s"
 %s: nelze najít vlastní spustitelný soubor
 %s: nelze najít spustitelný program postgres
 %s: nelze otevřít PID soubor "%s": %s
 %s: nelze otevřít token procesu: chybový kód %lu
 %s: nelze otevřít službu "%s": chybový kód %lu
 %s: nelze otevřít manažera služeb
 %s: nelze číst soubor "%s"
 %s: nelze zaregistrovat službu "%s": chybový kód %lu
 %s: nelze odstranit signální soubor pro povýšení (promote) "%s": %s
 %s: nelze poslat signál pro povýšení (promote, PID: %ld): %s
 %s: nelze poslat signál pro reload (PID: %ld): %s
 %s: nelze poslat signál pro reload %d (PID: %ld): %s
 %s: nelze poslat stop signál (PID: %ld): %s
 %s: nelze spustit server
Zkontrolujte záznam v logu.
 %s: nelze nastartovat server: návratový kód byl %d
 %s: nelze nastartovat službu "%s": chybový kód %lu
 %s: nelze odregistrovat službu "%s": chybový kód %lu
 %s: nelze čekat na server kvůli chybné konfiguraci
 %s: nelze zapsat do signálního souboru pro povýšení (promote) "%s": %s
 %s: inicializace databáze selhala
 %s: neplatná data v PID souboru "%s"
 %s: chýbějící parametr pro "kill" mód
 %s: není zadán datový adresář a ani není nastavena proměnná prostředí PGDATA
 %s: není specifikována operace
 %s: žádný server neběží
 %s: starý proces serveru (PID: %ld) zřejmě skončil
 %s: soubor s volbami "%s" musí mít přesně jednu řádku
 %s: nedostatek paměti
 %s: server se neukončuje
 %s: server běží (PID: %ld)
 %s: služba "%s" je již registrována
 %s: služba "%s" není registrována
 %s: server běží v single-user módu (PID: %ld)
 %s: příliš mnoho argumentů v příkazové řádce (první je "%s")
 %s: neplatný mód operace "%s"
 %s: neplatný mód ukončení mode "%s"
 %s: neplatné jméno signálu "%s"
 %s: neplatný typ spuštění "%s"
 (Implicitní chování je čekat na ukončení, ale ne při startu nebo restartu.)

 TIP: Volba "-m fast" okamžitě ukončí sezení namísto aby čekala
na odpojení iniciované přímo session.
 Pokud je vynechán parametr -D, použije se proměnná prostředí PGDATA.
 Běží server?
 Prosím ukončete single-user postgres a zkuste to znovu.
 Server nastartoval a přijímá spojení
 Program "%s" je vyžadován aplikací %s, ale nebyl nalezen ve stejném
adresáři jako "%s".
Zkontrolujte vaši instalaci.
 Program "%s" byl nalezen pomocí "%s",
ale nebyl ve stejné verzi jako %s.
Zkontrolujte vaši instalaci.
 Časový limit pro čekání na start serveru vypršel
 Zkuste "%s --help" pro více informací.
 Použití:
 VAROVÁNÍ: online backup mód je aktivní
Shutdown nebude ukončen dokud nebude zavolán pg_stop_backup().

 čekám na start serveru ...
 potomek skončil s návratovým kódem %d potomek skončil s nerozponaným stavem %d potomek byl ukončen vyjímkou 0x%X potomek byl ukončen signálem %d potomek byl ukončen signálem %s nelze změnit adresář na "%s" nelze najít spustitelný soubor "%s" nelze získat aktuální adresář: %s nelze číst binární soubor "%s" nelze číst symbolický link "%s" neplatný binární soubor"%s" server stále startuje
 server je povyšován (promote)
 server se ukončuje
 server obdržel signál
 server spuštěn
 server startuje
 server zastaven
 přesto server spouštím
 čekám na ukončení serveru ... čekám na start serveru ... 