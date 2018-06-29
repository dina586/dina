!macro CustomCodePostInstall
	;nsExec::ExecToStack `"$INSTDIR\App\bin\upx.exe" -d "$INSTDIR\App\SkypeInstaller\SkypeSetupFull.exe"`
	;Pop $R1 ;exit code
	;Pop $R2	;UPX output
	
	nsExec::Exec `"$INSTDIR\App\bin\7za.exe" x "$INSTDIR\App\SkypeInstaller\SkypeSetup_6.22.64.106.msi" -o"$INSTDIR\App\Skype\Phone"`
	Pop $R1 ;exit code
	
	;CreateDirectory "$INSTDIR\App\Skype\Apps\login"
	
	;nsExec::Exec `"$INSTDIR\App\bin\7za.exe" x "$INSTDIR\App\Skype\Phone\Login.cab" -o"$INSTDIR\App\Skype\Apps\login"`
	;Pop $R1 ;exit code
	
	RMDir /r "$INSTDIR\App\bin"
	RMDir /r "$INSTDIR\App\SkypeInstaller"

	Rename "$INSTDIR\App\Skype\Phone\Skype4COM.dll.65B9650E_D4EA_458D_AE52_454823D78F93" "$INSTDIR\App\Skype\Phone\Skype4COM.dll"
	Rename "$INSTDIR\App\Skype\Phone\SkypeThirdPartyAttributions" "$INSTDIR\App\Skype\Phone\third-party_attributions.txt"
	Delete "$INSTDIR\App\Skype\Phone\SkypeDesktopIni"
	Delete "$INSTDIR\App\Skype\Phone\Updater.exe"
	Delete "$INSTDIR\App\Skype\Phone\Updater.dll"
	;Delete "$INSTDIR\App\Skype\Phone\log*"
!macroend
