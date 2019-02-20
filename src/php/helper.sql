DELETE m, sg, sl, ss, scp, scru, scrc, scf, sck, scrt, sci, scd, st, tn
FROM members m
LEFT JOIN settingsGeneral sg ON m.s_id = sg.s_id
LEFT JOIN settingsLeague sl ON m.s_id = sl.s_id
LEFT JOIN settingsScoring ss ON m.s_id = ss.s_id
   LEFT JOIN scoringPassing scp ON m.s_id = scp.s_id
   LEFT JOIN scoringRushing scru ON m.s_id = scru.s_id
   LEFT JOIN scoringReceiving scrc ON m.s_id = scrc.s_id
   LEFT JOIN scoringFumbles scf ON m.s_id = scf.s_id
   LEFT JOIN scoringKicking sck ON m.s_id = sck.s_id
   LEFT JOIN scoringReturns scrt ON m.s_id = scrt.s_id
   LEFT JOIN scoringIdp sci ON m.s_id = sci.s_id
   LEFT JOIN scoringDefense scd ON m.s_id = scd.s_id
LEFT JOIN settingsTeams st ON m.s_id = st.s_id
   LEFT JOIN teamNames tn ON m.s_id = tn.s_id
WHERE m.m_id = '23D2C9A77690077635541227B5E1C2A6';