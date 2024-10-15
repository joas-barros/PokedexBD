--INSERINDO DADOS NA TABELA TIPO
INSERT INTO Tipo(Tipo_ID, Tipo_Nome) VALUES
(1, 'Normal'),
(2, 'Fogo'),
(3, 'Água'),
(4, 'Elétrico'),
(5, 'Planta'),
(6, 'Gelo'),
(7, 'Lutador'),
(8, 'Venenoso'),
(9, 'Terrestre'),
(10, 'Voador'),
(11, 'Psíquico'),
(12, 'Inseto'),
(13, 'Pedra'),
(14, 'Fantasma'),
(15, 'Dragão'),
(16, 'Sombrio'),
(17, 'Aço'),
(18, 'Fada');

--iNSERINDO DADOS NA TABELA FRAQUEZAS
INSERT INTO FRAQUEZAS(Tipo_ID, Fraqueza_1_ID, Fraqueza_2_ID, Fraqueza_3_ID,Fraqueza_4_ID, Fraqueza_5_ID) VALUES 
(1, 7, NULL, NULL, NULL, NULL),
(2, 3, 9, 12, NULL, NULL),
(3, 4, 5, NULL, NULL, NULL),
(4, 9, NULL, NULL, NULL, NULL),
(5, 2, 6, 8 ,10, 12),
(6, 2, 7, 13, 17, NULL),
(7, 10, 11, 18, NULL, NULL),
(8, 5, 9, NULL, NULL, NULL),
(9, 3, 5, 6, NULL, NULL),
(10, 4, 6, 13, NULL, NULL),
(11, 12, 14, 16, NULL, NULL),
(12, 2, 10, 13, NULL, NULL),
(13, 3, 5, 7, 9, 17),
(14, 14, 16, NULL, NULL, NULL),
(15, 6, 15, 18, NULL, NULL),
(16, 7, 12, 18, NULL, NULL),
(17, 2, 7, 9, NULL, NULL),
(18, 8, 17, NULL, NULL, NULL);

INSERT INTO Efeito (Efeito_ID, Efeito_Nome, Efeito_Info) VALUES
(1, 'Burn', 'A condição de queimadura (BRN) inflige dano de 1/16 do seu HP máximo a cada turno a cada turno e reduz pela metade o dano causado pelos movimentos físicos de um Pokémon (exceto Pokémon com Guts).'),
(2, 'Freeze', 'A condição de congelamento (FRZ) faz com que um Pokémon não consiga usar movimentos.'),
(3, 'Paralysis', 'A condição de paralisia (PAR) reduz a velocidade do Pokémon e faz com que ele tenha 25% de chance de ser incapaz de usar um movimento ("totalmente paralisado") ao tentar usá-lo.'),
(4, 'Poison', 'A condição de veneno (PSN) causa dano a cada turno, veneno inflige dano igual a 1/16 do seu HP máximo a cada turno.'),
(5, 'Sleep', 'A condição de sono (SLP) faz com que um Pokémon não consiga usar movimentos, exceto Snore e Sleep Talk.'),
(6, 'Ability Change', 'A habilidade de um Pokémon pode ser temporariamente alterada para outra durante uma batalha Pokémon.'),
(7, 'Ability suppression', 'A Habilidade de um Pokémon pode ser temporariamente desativada durante uma batalha Pokémon, impedindo seu efeito.'),
(8, 'Type change', 'Um Pokémon pode ter um ou mais tipos temporariamente alterados, adicionados ou removidos em batalha.'),
(9, 'Mimic', 'Se um Pokémon usar Mimic, este movimento será temporariamente substituído por outro movimento copiado do alvo.'),
(10, 'Substitute', 'O Pokémon que usa Substitute ou Shed Tail usa até 1/4 de seu HP total (arredondado para baixo) para fazer um substituto que irá absorver golpes até "quebrar" (o dano que o substituto sofre é igual ou maior ao HP usado para fazê-lo).'),
(11, 'Transformed', 'Um Pokémon é transformado no alvo com o uso de Transform. Além disso, Imposter (habilidade característica de Ditto) faz com que o usuário se transforme automaticamente no oponente.'),
(12, 'Illusion', 'Quando um Pokémon com a Habilidade Illusion entra em batalha, sua aparência é alterada para a do último Pokémon não-Ovo consciente do grupo de seu Treinador.'),
(13, 'Bound', 'Um Pokémon vinculado sofre dano no final de cada turno e não pode ser trocado ou fugir.'),
(14, 'Curse', 'Um Pokémon amaldiçoado (afetado por Curse usado por um Pokémon do tipo Ghost) sofre dano igual a 1/4 do seu HP máximo a cada turno.'),
(15, 'Nightmare', 'Pesadelo afeta apenas um Pokémon adormecido. O Pokémon adormecido perde 1/4 de seus pontos de vida máximos a cada turno. Se o Pokémon adormecido acordar, o pesadelo não terá mais efeito.'),
(16, 'Perish Song', 'Após três turnos, todos os Pokémon que ouviram a Perish Song desmaiarão. Pokémon com a habilidade Soundproof estão isentos e não desmaiarão. Qualquer Pokémon que ouvir isso pode evitar o efeito de desmaio se for substituido antes do término da contagem de três turnos.'),
(17, 'Seeded', 'Um Pokémon afetado por Leech Seed ou Sappy Seed perde HP a cada turno, e o Pokémon na posição de usuário daquele movimento tem seu HP curado. Em batalhas envolvendo vários Pokémon, se nenhum Pokémon estiver nessa posição (por exemplo, se ele desmaiou e não pôde ser substituído), nenhum HP será deduzido do Pokémon inicializado. No entanto, se um Pokémon for capaz de ocupar essa posição posteriormente (se tiver sido revivido), o HP será mais uma vez minado do Pokémon inicializado. Enquanto um Pokémon é propagado, mesmo que sua saúde não possa ser drenada por não haver nenhum Pokémon no slot apropriado para drenar seu HP, ele não pode ser propagado novamente.'),
(18, 'Salt Cure', 'Salt Cure inflige 1/8 do HP máximo do alvo como dano por turno, além do dano causado quando é usado. Se um tipo Aço e/ou Água for afetado por Salt Cure, a quantidade de dano por turno será 1/4 do seu HP máximo.'),
(19, 'Autotomize', 'Um Pokémon que usa o movimento Autotomize terá seu status de velocidade aumentado em dois estágios e (se o usuário alterar sua velocidade com sucesso) seu peso será reduzido em 220 libras. (100kg). Se o usuário alterar seu peso com sucesso, a mensagem "<Pokémon> tornou-se ágil!" é exibido. A perda de peso com Autotomize acumula, portanto, usá-las várias vezes continuará a diminuir o peso do usuário de acordo até atingir o peso mínimo. A redução de peso do Autotomize não pode ser transferida pelo Baton Pass ou removida pelo Haze. O peso de um Pokémon é redefinido se ele mudar de forma.'),
(20, 'Identified', 'A modificação de evasão do oponente não afetará a precisão de um Pokémon que usa Foresight, Odor Sleuth ou Miracle Eye. Além disso, um movimento do tipo Normal ou Fighting usado por um Pokémon que usou Foresight ou Odor Sleuth afetará os Pokémon do tipo Ghost, e os movimentos do tipo Psychic usados ​​por um Pokémon que usou Miracle Eye afetarão os Pokémon do tipo Dark.'),
(21, 'Minimize', 'Um Pokémon que usou o movimento Minimize (ou teve o efeito passado para ele via Baton Pass) será afetado de forma mais prejudicial por alguns movimentos, incluindo Stomp, Steamroller, Body Slam, Dragon Rush, Flying Press e Phantom Force.'),
(22, 'Tar Shot', 'Um Pokémon atingido pelo movimento Tar Shot tem a eficácia dos movimentos do tipo Fire usados ​​nele duplicada. Este efeito não acumula.'),
(23, 'Grounded', 'Se um Pokémon for imune a movimentos do tipo Ground por ser do tipo Flying, ter Levitate, segurar um Air Balloon ou estar sob o efeito de Magnet Rise ou Telekinesis, e for atingido por Smack Down ou Thousand Arrows, ele ficará aterrado. e perde sua imunidade a movimentos do tipo Ground.'),
(24, 'Magnetic levitation', 'Um Pokémon levitando sobre o magnetismo via Magnet Rise fica imune a ataques do tipo Ground por cinco turnos. Assim como os Pokémon do tipo Flying e os Pokémon com Levitate, o usuário é imune aos danos de Spikes e Toxic Spikes e não é afetado por Arena Trap. Magnet Rise é completamente negado por Gravity, Ingrain e segurando uma Iron Ball. Este efeito pode ser transferido pelo Baton Pass.'),
(25, 'Telekinesis', 'Um Pokémon levitado por Telecinese é imune a movimentos do tipo Ground, Spikes, Toxic Spikes e Arena Trap por três turnos. Além disso, todos os outros movimentos, exceto movimentos de nocaute de um golpe, atingem o alvo independentemente da precisão e da evasão; no entanto, não permite movimentos para atingir Pokémon semi-invulneráveis.'),
(26, 'Aqua Ring', 'Quando um Pokémon se envolve com um véu de água usando Aqua Ring, ele restaura 1/16 de seu HP máximo a cada turno. Este efeito pode ser transferido pelo Baton Pass.'),
(27, 'Rooting', 'Quando um Pokémon planta suas raízes usando Ingrain, ele restaura 1/16 de seu HP máximo a cada turno, mas não pode trocar ou fugir, mesmo se for atingido por um movimento que forçaria isso, como Roar e Dragon Tail.'),
(28, 'Laser Focus', 'Laser Focus faz com que os movimentos do usuário resultem em um acerto crítico até o final do próximo turno, a menos que o alvo desse movimento tenha Battle Armor, Shell Armor ou esteja sob o efeito de Lucky Chant. O efeito do Laser Focus pode ser copiado por Psych Up ou Transform.'),
(29, 'Taking Aim', 'Quando um Pokémon usa Mind Reader ou Lock-On para mirar em um alvo, o próximo movimento de dano do usuário atingirá esse alvo sem falhar, mesmo que o oponente use um movimento que ofereça um turno de semi-invulnerabilidade, como Fly. Este efeito pode ser passado com bastão.'),
(30, 'Charged', 'Um Pokémon Charged tem o poder de seu próximo movimento do tipo Elétrico duplicado.'),
(31, 'Stockpile Count', 'Quando o movimento Stockpile for usado, o usuário irá estocar energia; o usuário pode armazenar energia até três vezes. Os movimentos Spit Up e Swallow infligem danos e curam o usuário com base no número de estoques, respectivamente, mas também redefinem a contagem de estoques. Ambos os movimentos falham se a contagem do estoque for zero.'),
(32, 'Defense Curl', 'Usar Defense Curl faz com que o poder de Rollout e Ice Ball dobre para o Pokémon. Este efeito não é transferido pelo Baton Pass.'),
(33, 'Can`t Escape', 'Um Pokémon que não consegue escapar não pode trocar nem fugir enquanto o Pokémon que o prendeu estiver no campo.'),
(34, 'No Retreat', 'Um Pokémon que usa o movimento No Retreat ganhará uma variante da condição Can’t Escape. O movimento No Retreat falhará se o usuário já possuir a condição No retiro, porém um Pokémon que já possua a condição Can’t escape não pode ganhar a condição No retiro, permitindo que o movimento No Retreat seja usado múltiplas vezes sem falhar.'),
(35, 'Octolock', 'Octolock inflige uma variante da condição Não é possível escapar, que reduz adicionalmente a Defesa e a Defesa Especial do alvo em um estágio cada no final de cada turno.'),
(36, 'Disable', 'Um Pokémon sob o efeito de Desativar é incapaz de usar um movimento específico por 0 a 7 turnos.'),
(37, 'Embargo', 'Um Pokémon sob o efeito de Embargo não poderá usar seu item retido e seu Treinador não poderá usar itens nele (incluindo itens Wonder Launcher) por cinco turnos. Um Pokémon sob efeito de Embargo não pode usar Fling.'), 
(38, 'Heal Block', 'Um Pokémon afetado por Heal Block ou Psychic Noise é impedido de curar por cinco ou dois turnos, respectivamente.'),
(39, 'Imprison', 'Enquanto um Pokémon estiver sob o efeito do Imprison, seus oponentes não poderão usar nenhum movimento que também seja conhecido pelo usuário do Imprison.'),
(40, 'Taunt', 'Um Pokémon provocado não pode usar nenhum movimento de status por 3 turnos, incluindo movimentos de status que sempre se transformarão em movimentos prejudiciais, como Nature Power. O status Taunt só pode ser infligido pelo movimento Taunt.'),
(41, 'Throat Chop', 'Um Pokémon atingido pelo movimento Throat Chop não poderá usar movimentos baseados em som por dois turnos.'),
(42, 'Torment', 'Um Pokémon atormentado não pode usar o mesmo movimento duas vezes seguidas.'),
(43, 'Confusion', 'A condição confusa faz com que um Pokémon às vezes se machuque durante sua confusão, em vez de executar um movimento selecionado.'),
(44, 'Infatuation', 'Um Pokémon apaixonado não pode usar movimentos 50% das vezes, mesmo contra Pokémon diferentes daquele por quem está apaixonado. Um Pokémon permanecerá apaixonado enquanto o Pokémon que o apaixonou estiver em campo..'),
(45, 'Getting Pumped', 'Um Pokémon pode ser bombeado usando o movimento Focus Energy ou se o item Dire Hit for usado nele. Um Pokémon bombeado tem 75% menos probabilidade de acertar um acerto crítico como resultado de um bug.'),
(46, 'Guard Split', 'O movimento Guard Split calcula a média das estatísticas de Defesa e Defesa Especial do usuário com as do Pokémon alvo. As alterações nas estatísticas do usuário e do alvo são ignoradas no cálculo da média.'),
(47, 'Power Slit', 'O movimento Power Split calcula a média das estatísticas de Ataque e Ataque Especial do usuário com as do Pokémon alvo. As alterações nas estatísticas do usuário e do alvo são ignoradas no cálculo da média.'),
(48, 'Speed Swap', 'O movimento Speed ​​Swap troca a estatística de velocidade do usuário com a do Pokémon alvo. Este movimento não troca modificadores de velocidade em batalha, como habilidades e estágios de estatísticas.'),
(49, 'Power Trick', 'O movimento Power Trick troca a estatística base de Ataque e a estatística base de Defesa do usuário. Este efeito é passado por Baton Pass.'),
(50, 'Choice Lock', 'Quando um Pokémon segurando Choice Band, Choice Specs ou Choice Scarf seleciona um movimento pela primeira vez, ele só poderá usar esse movimento até ser trocado.'),
(51, 'Encore', 'O Encore força o Pokémon a repetir seu último ataque por 2 a 5 turnos; se o Pokémon tiver Magic Coat ativo, o movimento falhará.'), 
(52, 'Rampage', 'Se um Pokémon usar Thrash, Outrage, Petal Dance, Rage ou Raging Fury, ele será forçado a usar esse movimento por 2-3 turnos e ficará confuso no final.'),
(53, 'Rolling', 'Se um Pokémon usar Rollout ou Ice Ball, ele será forçado a usar esse movimento por 5 turnos, dobrando seu poder a cada golpe consecutivo.'),
(54, 'Making an Uproar', 'Se um Pokémon usar Uproar, ele será forçado a usar esse movimento por 3 turnos. Enquanto um Pokémon estiver causando alvoroço, outros Pokémon não conseguirão dormir (exceto os Pokémon com a habilidade Soundproof).'),
(55, 'Bide', 'Se um Pokémon usar Bide, o usuário não poderá selecionar um movimento por um período de inatividade de 2 turnos, embora ainda seja possível trocar durante o efeito do movimento. Depois disso, Bide causará dano igual ao dobro do dano recebido durante o período de inatividade. Se o usuário não for atacado diretamente durante o período de lance, o Bide falhará no turno que teria lançado.'),
(56, 'Recharging', 'Um Pokémon que use certos movimentos com sucesso deverá recarregar durante o próximo turno. Durante a recarga, o Pokémon não pode realizar nenhuma ação.'),
(57, 'Charging Turn', 'Vários movimentos de dois turnos têm um turno em que um Pokémon não pode agir. O carregamento pode ser ignorado com uma Power Herb ou, no caso de Solar Beam e Solar Blade, na presença de luz solar intensa. Os Pokémon que estão preparando o Sky Attack ficam cobertos de luz. Pokémon que estão preparando Solar Beam ou Solar Blade absorvem a luz solar. Pokémon que estão preparando Razor Wind criam um redemoinho.'),
(58, 'Flinch', 'O status de Flinch impede que um Pokémon ataque durante um turno.'),
(59, 'Bracing', 'Quando um Pokémon usa Endure, ele se prepara para que sempre que sofrer dano naquele turno, ele sempre sobreviva com pelo menos 1 HP. O Focus Sash, Focus Band e Ability Sturdy têm efeitos semelhantes.'),
(60, 'Center of Attention', 'Se um Pokémon for o centro das atenções, seus oponentes serão forçados a mirar no centro das atenções, e não no alvo pretendido.'),
(61, 'Magic Coat', 'Um Pokémon envolto em Magic Coat refletirá a maioria dos movimentos de status usados ​​contra ele ou seu lado do campo de volta para o usuário durante o turno em que usou o movimento. A habilidade Magic Bounce reflete os mesmos movimentos.'),
(62, 'Protection', 'A protected Pokémon will be unaffected by physical, special, and/or status moves during one turn depending on the protection move used.');

INSERT INTO Habilidade (Habilidade_ID, Habilidade_Tipo, Habilidade_Nome, Habilidade_Descricao, Habilidade_Efeito) VALUES
--1 Gen Normal
(1, 1, 'Barrage', 'Objetos redondos são arremessados ​​no alvo para atingir duas a cinco vezes seguidas.', NULL),
(2, 1, 'Bide', 'O usuário suporta ataques por dois turnos e depois contra-ataca para causar o dobro do dano recebido.', NULL),
(3, 1, 'Bind', 'Um corpo longo, tentáculos ou algo semelhante são usados ​​para amarrar e apertar o alvo por quatro a cinco turnos.', NULL),
(4, 1, 'Body Slam', 'O usuário ataca caindo sobre o alvo com todo o peso do corpo. Isso também pode deixar o alvo paralisado.', NULL),
(5, 1, 'Comet Punch', 'The target is hit with a flurry of punches that strike two to five times in a row.', NULL),
(6, 1, 'Constrict', 'O alvo é atacado com tentáculos longos e rastejantes, trepadeiras ou similares. Isso também pode diminuir a estatística de velocidade do alvo.', NULL),
(7, 1, 'Conversion', 'O usuário altera seu tipo para se tornar o mesmo tipo do movimento no topo da lista de movimentos que ele conhece.', NULL),
(8, 1, 'Cut', 'O alvo é cortado com uma foice, garra ou algo semelhante para infligir dano', NULL),
(9, 1, 'Defense Curl', 'O usuário se enrola e aumenta seu status de Defesa.', 32),
(10, 1, 'Disable', 'Por quatro turnos, o alvo não poderá usar o último movimento usado.', 36),
(11, 1, 'Dizzy Punch', 'O alvo é atingido com socos lançados ritmicamente. Isso também pode deixar o alvo confuso.', 43),
(12, 1, 'Double Slap', 'O alvo recebe tapas repetidamente, para frente e para trás, de duas a cinco vezes seguidas.', NULL),
(13, 1, 'Double-Edge', 'Um ataque imprudente com risco de vida em que o usuário ataca o alvo. Isso também prejudica bastante o usuário.', NULL),
(14, 1, 'Egg Bomb', 'Um ovo grande é lançado no alvo com força máxima para causar dano.', NULL),
(15, 1, 'Explosion', 'O usuário ataca tudo ao seu redor causando uma tremenda explosão. O usuário desmaia ao usar este movimento.', NULL),
(16, 1, 'Flash', 'O usuário emite uma luz brilhante que corta a precisão do alvo.', NULL),
(17, 1, 'Focus Energy', 'O usuário respira fundo e se concentra para que seus ataques futuros tenham uma chance maior de acertar acertos críticos.', NULL),
(18, 1, 'Fury Attack', 'O usuário ataca atacando o alvo com um chifre, bico ou algo semelhante. Este movimento atinge duas a cinco vezes seguidas.', NULL),
(19, 1, 'Fury Swipes', 'O usuário ataca atacando o alvo com garras, foices ou algo semelhante. Este movimento atinge duas a cinco vezes seguidas.', NULL),
(20, 1, 'Glare', 'O usuário intimida o alvo com o padrão em sua barriga para causar paralisia.', 3),
(21, 1, 'Growl', 'O usuário rosna de uma forma cativante, tornando o Pokémon adversário menos cauteloso. Isso reduz suas estatísticas de ataque.', NULL),
(22, 1, 'Growth', 'O corpo do usuário cresce de uma só vez, aumentando o Ataque e o Sp. Estatísticas de ataque.', NULL),
(23, 1, 'Guillotine', 'Um ataque violento e dilacerante com grandes pinças. O alvo desmaia instantaneamente se este ataque acertar.', NULL),
(24, 1, 'Harden', 'O usuário enrijece todos os músculos do corpo para aumentar seu status de Defesa.', NULL),
(25, 1, 'Headbutt', 'O usuário estica a cabeça e ataca atacando diretamente o alvo. Isso também pode fazer o alvo recuar.', NULL),
(26, 1, 'Horn Attack', 'O alvo é atingido por um chifre pontiagudo para causar dano.', NULL),
(27, 1, 'Horn Drill', 'O usuário apunhala o alvo com um chifre que gira como uma furadeira. O alvo desmaia instantaneamente se este ataque acertar.', NULL),
(28, 1, 'Hyper Beam', 'The target is attacked with a powerful beam. The user can`t move on the next turn.', NULL),
(29, 1, 'Hyper Fang', 'O usuário morde o alvo com força com suas presas frontais afiadas. Isso também pode fazer o alvo recuar.', NULL),
(30, 1, 'Leer', 'O usuário dá ao Pokémon adversário um olhar intimidador que reduz suas estatísticas de defesa.', NULL),
(31, 1, 'Lovely Kiss', 'Com uma cara assustadora, o usuário tenta beijar o alvo. Se tiver sucesso, o alvo adormece.', 5),
(32, 1, 'Mega Kick', 'O alvo é atacado por um chute lançado com força muscular.', NULL),
(33, 1, 'Mega Punch', 'O alvo é atingido por um soco lançado com força muscular.', NULL),
(34, 1, 'Metronome', 'O usuário balança um dedo e estimula seu cérebro a usar praticamente qualquer movimento aleatoriamente.', NULL),
(35, 1, 'Mimic', 'O usuário copia o último movimento usado pelo alvo. O movimento copiado pode ser usado até que o usuário do Mimic saia da batalha.', 9),
(36, 1, 'Minimize', 'O usuário comprime seu corpo para parecer menor, o que aumenta drasticamente sua evasão.', 21),
(37, 1, 'Pay Day', 'Moedas são arremessadas no alvo para causar dano. O dinheiro é ganho após a batalha.', NULL),
(38, 1, 'Pound', 'O alvo é golpeado fisicamente com uma cauda longa, uma perna dianteira ou algo semelhante.', NULL),
(39, 1, 'Quick Attack', 'O usuário ataca o alvo para causar dano, movendo-se a uma velocidade ofuscante. Esse movimento sempre vem primeiro.', NULL),
(40, 1, 'Rage', 'Enquanto este movimento estiver em uso, o poder da raiva aumenta a estatística de Ataque cada vez que o usuário é atingido em batalha.', NULL),
(41, 1, 'Razor Wind', 'Neste ataque de dois turnos, lâminas de vento atingem o Pokémon adversário no segundo turno. Acertos críticos acertam com mais facilidade.', NULL),
(42, 1, 'Recover', 'O usuário regenera suas células, restaurando seu próprio HP em até metade do seu HP máximo.', NULL),
(43, 1, 'Roar', 'O alvo se assusta e um Pokémon diferente é arrastado. Na natureza, isso encerra uma batalha contra um único Pokémon.', NULL),
(44, 1, 'Scratch', 'Garras duras, pontiagudas e afiadas arranham o alvo para infligir danos.', NULL),
(45, 1, 'Screech', 'Um grito ensurdecedor reduz drasticamente as estatísticas de Defesa do alvo.', NULL),
(46, 1, 'Self-Destruct', 'The user attacks everything around it by causing an explosion. The user faints upon using this move.', NULL),
(47, 1, 'Sharpen', 'O usuário deixa suas bordas mais irregulares, o que aumenta sua estatística de Ataque.', NULL),
(48, 1, 'Sing', 'Uma canção de ninar suave é cantada com uma bela voz que faz o alvo dormir.', 5),
(49, 1, 'Skull Bash', 'O usuário enfia a cabeça para aumentar sua estatística de Defesa no primeiro turno e, em seguida, ataca o alvo no próximo turno.', NULL),
(50, 1, 'Slam', 'O alvo é atingido com uma cauda longa, vinhas ou algo semelhante para causar dano.', NULL),
(51, 1, 'Slash', 'O alvo é atacado com um golpe de garras, foices ou algo semelhante. Este movimento tem uma chance maior de acertar um acerto crítico.', NULL),
(52, 1, 'Smokescreen', 'O usuário libera uma nuvem obscura de fumaça ou tinta. Isso diminui a precisão do alvo.', NULL),
(53, 1, 'Soft-Boiled', 'O usuário restaura seu próprio HP em até metade do seu HP máximo.', NULL),
(54, 1, 'Sonic Boom', 'The target is hit with a destructive shock wave that always inflicts 20 HP damage.', NULL),
(55, 1, 'Spike Cannon', 'Pontas afiadas são disparadas contra o alvo em rápida sucessão. Eles acertaram de duas a cinco vezes seguidas.', NULL),
(56, 1, 'Splash', 'O usuário simplesmente cai e espirra sem nenhum efeito...', NULL),
(57, 1, 'Stomp', 'O usuário ataca pisando no alvo com um pé grande. Isso também pode fazer o alvo recuar', NULL),
(58, 1, 'Strength', 'O alvo é atingido com um soco lançado com potência máxima.', NULL),
(59, 1, 'Struggle', 'Este ataque é usado em desespero apenas se o usuário não tiver PP restante. Também prejudica um pouco o usuário.', NULL),
(60, 1, 'Substitute', 'O usuário cria um substituto para si mesmo usando alguns de seus próprios HP. O substituto serve como isca do usuário.', 10),
(61, 1, 'Super Fang', 'O usuário morde o alvo com força com suas presas frontais afiadas. Isso corta o HP do alvo pela metade.', NULL),
(62, 1, 'Supersonic', 'O usuário gera ondas sonoras estranhas de seu corpo que confundem o alvo', 43),
(63, 1, 'Swift', 'Raios em forma de estrela são disparados contra Pokémon adversários. Este ataque nunca erra.', NULL),
(64, 1, 'Swords Dance', 'Uma dança frenética para elevar o espírito de luta. Isso aumenta drasticamente a estatística de ataque do usuário.', NULL),
(65, 1, 'Tackle', 'Um ataque físico em que o usuário ataca e atinge o alvo com todo o corpo.', NULL),
(66, 1, 'Tail Whip', 'O usuário balança o rabo de maneira fofa, tornando o Pokémon adversário menos cauteloso. Isso reduz suas estatísticas de defesa.', NULL),
(67, 1, 'Take Down', 'Um ataque imprudente de carga de corpo inteiro para atingir o alvo. Isso também prejudica um pouco o usuário.', NULL),
(68, 1, 'Thrash', 'O usuário ataca e ataca por dois a três turnos. O usuário então fica confuso.', 43),
(69, 1, 'Transform', 'O usuário se transforma em uma cópia do alvo, passando a ter o mesmo movimento definido.', 11),
(70, 1, 'Tri Attack', 'O usuário ataca com um ataque simultâneo de três feixes. Isso também pode queimar, congelar ou paralisar o alvo.', NULL),
(71, 1, 'Vise Grip', 'O alvo é agarrado e apertado por ambos os lados para causar dano.', NULL),
(72, 1, 'Whirlwind', 'O alvo é surpreendido e um Pokémon diferente é arrastado para fora. Na natureza, isso encerra uma batalha contra um único Pokémon.', NULL),
(73, 1, 'Wrap', 'Um corpo longo, trepadeiras ou similares são usados ​​para envolver e apertar o alvo por quatro a cinco turnos.', NULL),
--Exclusive Fire
(74, 2, 'Blaze', 'Aumenta os movimentos do tipo Fire quando o HP do Pokémon está baixo.', NULL),
(75, 2, 'Flame Body', 'O contato com o Pokémon pode queimar o atacante.', 1),
(76, 2, 'Magma Armor', 'A camada de magma quente do Pokémon evita que ele congele.', NULL),
(77, 2, 'White Smoke', 'O Pokémon é protegido por sua fumaça branca, o que impede que outros Pokémon baixem suas estatísticas', NULL),
--Fire Gen 1
(78, 2, 'Ember', 'O alvo é atacado com pequenas chamas. Isso também pode deixar o alvo queimado.', 1),
(79, 2, 'Fire Blast', 'The target is attacked with an intense blast of all-consuming fire. This may also leave the target with a burn.', 1),
(80, 2, 'Fire Punch', 'O alvo é atacado com um soco de fogo. Isso também pode deixar o alvo queimado.', 1),
(81, 2, 'Fire Spin', 'The user traps the target inside a fierce vortex of fire that inflicts damage for four to five turns.', NULL),
(82, 2, 'Flamethrower', 'O alvo é queimado por uma intensa rajada de fogo. Isso também pode deixar o alvo queimado.', 1),
--Exclusise Water 
(83, 3, 'Drizzle', 'O Pokémon faz chover quando entra em batalha.', NULL),
(84, 3, 'Torrent', 'Aumenta os movimentos do tipo Água quando o HP do Pokémon está baixo.', NULL),
(85, 3, 'Water Veil', 'O véu de água do Pokémon evita que ele seja queimado.', NULL),
(86, 3, 'Mega Launcher', 'Ativa movimentos de pulso.', NULL),
--Water Gen 1
(87, 3, 'Bubble', 'Um spray de inúmeras bolhas é lançado contra o Pokémon adversário. Isso também pode diminuir sua estatística de velocidade.', NULL),
(88, 3, 'Bubble Beam', 'Um jato de bolhas é ejetado com força no alvo. Isso também pode diminuir a estatística de velocidade do alvo.', NULL),
(89, 3, 'Clamp', 'O alvo é preso e comprimido pela concha muito grossa e resistente do usuário por quatro a cinco voltas.', NULL),
(90, 3, 'Crabhammer', 'O alvo é martelado com uma pinça grande. Este movimento tem uma chance maior de acertar um acerto crítico.', NULL),
(91, 3, 'Hydro Pump', 'O alvo é atingido por um enorme volume de água lançado sob grande pressão.', NULL),
(92, 3, 'Surf', 'O usuário ataca tudo ao seu redor inundando o ambiente com uma onda gigante.', NULL),
(93, 3, 'Water Gun', 'O alvo é atingido com um forte jato de água.', NULL),
(94, 3, 'Waterfall', 'O usuário ataca o alvo e pode fazê-lo recuar.', NULL),
(95, 3, 'Withdraw', 'O usuário retira seu corpo para dentro de sua casca dura, aumentando seu status de Defesa.', NULL),
--Exclusive Electric
(96, 4, 'Static', 'O Pokémon está carregado de eletricidade estática e pode paralisar os atacantes que fizerem contato direto com ele.', 3),
(97, 4, 'Volt Absorb', 'Se for atingido por um movimento do tipo Elétrico, o Pokémon terá seu HP restaurado em vez de sofrer danos.', NULL),
(98, 4, 'Motor Drive', 'O Pokémon não sofre danos quando atingido por golpes do tipo Elétrico. Em vez disso, sua estatística de velocidade é aumentada.', NULL),
(99, 4, 'Electric Surge', 'Transforma o solo em Electric Terrain quando o Pokémon entra em batalha.', NULL),
--Electric Gen 1 
(100, 4, 'Thunder', 'Um raio perverso é lançado sobre o alvo para causar dano. Isso também pode deixar o alvo paralisado.', 3),
(101, 4, 'Thunder Punch', 'O alvo é atacado com um soco eletrificado. Isso também pode deixar o alvo paralisado.', 3),
(102, 4, 'Thunder Shock', 'O usuário ataca o alvo com uma descarga elétrica. Isso também pode deixar o alvo paralisado.', 3),
(103, 4, 'Thunder Wave', 'O usuário lança um choque fraco de eletricidade que paralisa o alvo.', 3),
(104, 4, 'Thunderbolt', 'O usuário ataca o alvo com uma forte explosão elétrica. Isso também pode deixar o alvo com paralisia', 3),
--Plant Exclusive 
(105, 5, 'Chlorophyll', 'Aumenta a estatística de velocidade do Pokémon sob luz solar intensa.', NULL),
(106, 5, 'Effect Spore', 'O contato com o Pokémon pode causar veneno, sono ou paralisia ao atacante.', 4),
(107, 5, 'Overgrow', 'Aumenta os movimentos do tipo Grass quando o HP do Pokémon está baixo.', NULL),
(108, 5, 'Leaf Guard', 'Evita condições de status sob luz solar intensa.', NULL),
(109, 5, 'Wind Rider', 'Aumenta a estatística de ataque do Pokémon se Tailwind entrar em vigor ou se o Pokémon for atingido por um movimento de vento. O Pokémon também não sofre danos com movimentos de vento.', NULL),
(110, 5, 'Harvest', 'Pode criar outra Berry após uma ser usada.', NULL),
(111, 5, 'Grassy Surge', 'Transforma o chão em Grassy Terrain quando o Pokémon entra em batalha.', NULL),
--Plant Gen 1
(112, 5, 'Absorb', 'Um ataque de drenagem de nutrientes. O HP do usuário é restaurado em até metade do dano sofrido pelo alvo.', NULL),
(113, 5, 'Leech Seed', 'Uma semente é plantada no alvo. Ele rouba um pouco de HP do alvo a cada turno.', 17),
(114, 5, 'Mega Drain', 'Um ataque de drenagem de nutrientes. O HP do usuário é restaurado em até metade do dano sofrido pelo alvo.', NULL),
(115, 5, 'Petal Dance', 'O usuário ataca o alvo espalhando pétalas por dois a três turnos. O usuário então fica confuso.', 43),
(116, 5, 'Razor Leaf', 'Folhas com pontas afiadas são lançadas para atacar os Pokémon adversários. Este movimento tem uma chance maior de acertar um acerto crítico', NULL),
(117, 5, 'Sleep Powder', 'O usuário espalha uma nuvem de poeira soporífica que faz o alvo dormir.', 5),
(118, 5, 'Solar Beam', 'O usuário coleta luz no primeiro turno e, em seguida, emite um feixe agrupado no próximo turno.', NULL),
(119, 5, 'Spore', 'O usuário espalha rajadas de esporos que induzem ao sono.', 5),
(120, 5, 'Stun Spore', 'O usuário espalha uma nuvem de pó anestésico que paralisa o alvo', 3),
(121, 5, 'Vine Whip', 'O alvo é atingido por vinhas delgadas em forma de chicote para causar dano.', NULL),
--Ice Exclusive
(122, 6, 'Refrigerate', 'Movimentos do tipo normal tornam-se movimentos do tipo Ice. O poder desses movimentos aumenta um pouco.', NULL),
(123, 6, 'Slush Rush', 'Aumenta a estatística de velocidade do Pokémon na neve.', NULL),
(124, 6, 'Snow Cloak', 'Aumenta a evasão do Pokémon na neve.', NULL),
(125, 6, 'Snow Warning', 'O Pokémon faz nevar quando entra em uma batalha.', NULL),
--Ice Gen 1
(126, 6, 'Aurora Beam', 'O alvo é atingido por um raio da cor do arco-íris. Isso também pode diminuir as estatísticas de ataque do alvo.', NULL),
(127, 6, 'Blizzard', 'Uma nevasca uivante é convocada para atacar o Pokémon adversário. Isso também pode deixar o Pokémon adversário congelado.', 2),
(128, 6, 'Haze', 'O usuário cria uma névoa que elimina todas as alterações de estatísticas entre todos os Pokémon envolvidos na batalha.', NULL),
(129, 6, 'Ice Beam', 'O alvo é atingido por um feixe de energia gelado. Isto também pode deixar o alvo congelado.', 2),
(130, 6, 'Ice Punch', 'O alvo é atacado com um soco gelado. Isto também pode deixar o alvo congelado.', 2),
(131, 6, 'Mist', 'O usuário cobre a si mesmo e a seus aliados com uma névoa branca que impede que qualquer uma de suas estatísticas seja reduzida por cinco turnos.', NULL),
--Fighting Gen 1
(132, 7, 'Counter', 'Um ataque retaliatório que contraria qualquer movimento físico, infligindo o dobro do dano recebido.', NULL),
(133, 7, 'Double Kick', 'O usuário ataca chutando o alvo duas vezes seguidas usando os dois pés.', NULL),
(134, 7, 'High Jump Kick', 'O alvo é atacado com um chute no joelho durante um salto. Se este movimento falhar, o usuário sofre dano.', NULL),
(135, 7, 'Jump Kick', 'O usuário salta alto e então ataca com um chute. Se o chute errar, o usuário se machuca.', NULL),
(136, 7, 'Karate Chop', 'O alvo é atacado com um golpe certeiro. Acertos críticos acertam com mais facilidade.', NULL),
(137, 7, 'Low Kick', 'Um poderoso chute baixo que faz o alvo cair. Quanto mais pesado o alvo, maior o poder do movimento', NULL),
(138, 7, 'Rolling Kick', 'O usuário ataca com um chute rápido e giratório. Isso também pode fazer o alvo recuar.', NULL),
(139, 7, 'Seismic Toss', 'O alvo é lançado usando o poder da gravidade. Inflige dano igual ao nível do usuário.', NULL),
(140, 7, 'Submission', 'O usuário agarra o alvo e mergulha imprudentemente no chão. Isso também prejudica um pouco o usuário.', NULL),
--Poison Exclusive
(141, 8, 'Liquid Ooze', 'O forte fedor do líquido exsudado do Pokémon causa danos aos atacantes que usam movimentos que drenam HP.', NULL),
(142, 8, 'Stench', 'Ao liberar um fedor ao atacar, o Pokémon pode fazer o alvo recuar.', NULL),
(143, 8, 'Corrosion', 'O Pokémon pode envenenar o alvo mesmo que seja do tipo Aço ou Venenoso.', 4),
(144, 8, 'Acid', 'Os Pokémon adversários são atacados com um spray de ácido forte. Isso também pode diminuir seu Sp. Estatísticas de definição.', NULL),
(145, 8, 'Acid Armor', 'O usuário altera sua estrutura celular para se liquefazer, aumentando drasticamente seu status de Defesa.', NULL),
(146, 8, 'Poison Gas', 'Uma nuvem de gás venenoso é espalhada nos rostos dos Pokémon adversários, envenenando aqueles que atinge.', 4),
(147, 8, 'Poison Powder', 'O usuário espalha uma nuvem de poeira venenosa que envenena o alvo.', 4),
(148, 8, 'Poison Sting', 'O usuário esfaqueia o alvo com um ferrão venenoso para causar dano. Isso também pode envenenar o alvo.', 4),
(149, 8, 'Sludge', 'The user hurls unsanitary sludge at the target to inflict damage. This may also poison the target.', 4),
(150, 8, 'Smog', 'O alvo é atacado com uma descarga de gases imundos. Isso também pode envenenar o alvo.', 4),
(151, 8, 'Toxic', 'Um movimento que deixa o alvo gravemente envenenado. Seu dano venenoso piora a cada turno.', 4),
--Ground Exclusive
(152, 9, 'Arena Trap', 'Impede que Pokémon adversários fujam da batalha.', NULL),
(153, 9, 'Bone Club', 'O usuário bate no alvo com um osso. Isso também pode fazer o alvo recuar.', 58),
(154, 9, 'Bonemerang', 'O usuário joga o osso que segura. O osso gira para danificar o alvo duas vezes – indo e vindo.', NULL),
(155, 9, 'Dig', 'O usuário se enterra no chão no primeiro turno e ataca no próximo turno.', NULL),
(156, 9, 'Earthquake', 'O usuário desencadeia um terremoto que atinge todos os Pokémon ao seu redor.', NULL),
(157, 9, 'Fissure', 'O usuário abre uma fissura no chão e deixa cair o alvo. O alvo desmaia instantaneamente se o ataque acertar.', NULL),
(158, 9, 'Sand Attack', 'A areia é atirada na cara do alvo, diminuindo a precisão do alvo.', NULL),
--Flying Exlusive



INSERT INTO Pokedex (Pokedex_Num, Pokedex_Nome, Pokedex_Tipo_1, Pokedex_Tipo_2, Pokedex_Taxa_Captura, Pokedex_Info) VALUES 
()

INSERT INTO Evolucao (Anterior, Sucessor) VALUES
()

INSERT INTO Pokemon (Pokemon_ID, Pokedex_Nome, Pokemon_Habilidade_1, Pokemon_Habilidade_2, Pokemon_Habilidade_3, Pokemon_Habilidade_4,
Pokemon_Level_MIN, Pokemon_Level_MAX, Pokemon_HP_MIN, Pokemon_HP_MAX, Pokemon_ATK_MIN, Pokemon_ATK_MAX,
Pokemon_DEF_MIN, Pokemon_DEF_MAX, Pokemon_SP_ATK_MIN, Pokemon_SP_ATK_MAX, Pokemon_SP_DEF_MIN, Pokemon_SP_DEF_MAX,
Pokemon_VELOCIDADE_MIN, Pokemon_VELOCIDADE_MAX, Pokemon_Sexo, Pokemon_Altura, Pokemon_Peso, Pokemon_IMG) VALUES\
()

INSERT INTO Treinador (Treinador_ID, Treinador_Nome) VALUES
()

INSERT INTO Registro_Pokedex (Pokemon_ID, Treinador_ID) VALUES
()

