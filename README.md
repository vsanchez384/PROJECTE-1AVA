# PROJETCE VIDEOJOC (1a Avaluació)

Projecte de la primera avaluació del mòdul Implantació d’Aplicacions Web - 2n ASIX fent ús de PHP.

> Descripció del problema

Imaginam que disposam d’un fitxer de dades en format JSON que conté informació de videojocs. 

Es necessita el següent: 

Analitzar mitjançant cerques la informació que hi ha dins del fitxer.
Depurar la informació que hi ha dins del fitxer.

> Operacions a dur a terme i especificacions

1. Pàgina web amb un menú principal que ha de permetre l’accés a totes les funcionalitats especificades en aquest programa. 

- a Donar disseny especial a la pàgina, fent ús de CSS …

2. Funcionalitat 1: mostra de videojocs. 

- a S’han de mostrar per pantalla la informació dels videojocs del fitxer.
- b Mostrar la informació dins d’una taula. Important donar un disseny atractiu. 
- c Implementar-ho mitjançant funcions

3. Funcionalita 2: assignar codi
- a Funció que assigni un codi als videojocs del fitxer.
- b Si el fitxer JSON inicial ja té el camp codi amb un valor assignat , no ha d’assignar cap codi al videojoc i sinó en té li ha d’assignar un codi.
- c La informació ha de ser desada dins del mateix fitxer original. S’ha de sobreescriure el fitxer original, ha de tenir el mateix que tenia inicialment més el codi afegit. 
- d S’ha d’implementar mitjançant funcions. 

4. Funcionalitat 3: eliminar videojocs .
- a S’ha de crear un fitxer JSON_Resultat_Eliminar.json que ha de contenir el mateix que el fitxer json inicial eliminant els videojocs amb data de llançament entre dues dates (data1: XXX, data2: XXX)
- b Implementar-ho mitjançant funcions

5. Funcionalitat 4: Afegir data expiració. 
- a S’ha de crear un fitxer JSON_Resultat_Data_Expiració.json que ha de contenir el mateix que el fitxer inicial més un camp data expiració per a cada videojocs. Aquesta data d’expiració ha de ser la data de desenvolupament més 5 anys.
- b Implementar-ho mitjançant funcions
 
6. Funcionalitat 5: Comprovar repetits. 
- a S’ha de fer una cerca al fitxer inicial per comprovar si hi ha registres repetits. En cas que n’hi hagi ha de mostrar per pantalla un missatge que digui que hi ha registres repetits
- b Implementar-ho amb una funció que torni 1 si hi ha repetits i 0 sinó n’hi ha . 

7. Funcionalitat 6: Comprovar repetits ampliada. 
- a S’ha de fer una cerca al fitxer inicial per comprovar si hi ha registres repetits. En cas que n’hi hagi ha de crear un fitxer anomenat JSON_Resultat_repetits.json que contingui els registres repetits. 
- b Implementar-ho mitjançant funcions

8. Funcionalitat 7: Eliminar repetits. 
- a S’ha de fer una cerca al fitxer inicial per comprovar si hi ha registres repetits. En cas que n’hi hagi ha de crear un fitxer anomenat JSON_Resultat_eliminar_repetits.json que contingui tots els registres del fitxer inicial eliminant repeticions 
- b Implementar-ho mitjançant funcions

9. Funcionalitat 8: Videojoc més modern i més antic.
- a S’ha de fer una cerca que mostri per pantalla les dades del videojoc més modern i les del més antic.
- b Implementar-ho mitjançant funcions

10. Funcionalitat 9: Ordenació alfabètica de videojocs.
- a Funció que tregui per pantalla els videojocs de forma ordenada i apart desi la informació dins d’un fitxer JSON_Resultat_ordenat_alfabetic.json
- b Implementar-ho mitjançant funcions


> A tenir en compte: 
1. El codi ha d’estar ben estructurat i ha de ser modular , el que implica que és important fer ús de funcions implementades per vosaltres mateixos.
2. Intenta sempre que sigui possible fer ús de funcions del propi llenguatge PHP per tal d’optimitzar el codi.
3. Totes les funcions poden estar implementades en un arxiu apart.
4. Els blocs de codi han d’estar documentats. 
5. Fer ús de GitHub a cada sessió de classe. Al final de cada sessió s’ha de fer commit al GitHub.
6. La pràctica es durà a terme en grups de 2 persones, que podreu formar vosaltres mateixos. 